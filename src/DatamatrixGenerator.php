<?php

namespace Bluspark\DgfipDatamatrix;

use Bluspark\DgfipDatamatrix\Subset\FirstSubset;
use Bluspark\DgfipDatamatrix\Subset\SecondSubset;
use Bluspark\DgfipDatamatrix\Subset\SixthSubset;
use Bluspark\DgfipDatamatrix\Subset\ThirdSubset;
use InvalidArgumentException;

class DatamatrixGenerator
{
    public function generate(DatamatrixReference $datamatrixReference): DgfipDatamatrix
    {
        // Ensure that all data is present
        if (!$datamatrixReference->isComplete()) {
            throw new InvalidArgumentException('All required fields must be set');
        }

        $donneesMetiers = str_repeat(' ', 40);
        $spaceZone = str_repeat(' ', 24);

        $firstSubset = new FirstSubset($datamatrixReference->getAmountInCents());
        $secondSubset = new SecondSubset(
            fiscalYear: $datamatrixReference->getFiscalYear(),
            periodCode: $datamatrixReference->getPeriodeCode(),
            invoiceNumber: $datamatrixReference->getInvoiceNumber(),
            accountantCode: $datamatrixReference->getAccountantCode(),
        );
        $thirdSubset = new ThirdSubset($datamatrixReference->getEmitterCode());
        $sixthSubset = new SixthSubset(
            establishmentCode: $datamatrixReference->getEstablishmentCode(),
            periodCode: $datamatrixReference->getPeriodeCode(),
            revenueCode: $datamatrixReference->getRevenueCode(),
            fiscalYear: $datamatrixReference->getFiscalYear(),
        );

        return new DgfipDatamatrix(
            $donneesMetiers
            . $spaceZone
            . $sixthSubset->getSubsetString()
            . $sixthSubset->getSubsetKey()
            . $thirdSubset->getSubsetString()
            . $thirdSubset->getSubsetKey()
            . ' '
            . $secondSubset->getSubsetKey()
            . $secondSubset->getSubsetString()
            . $firstSubset->getSubsetKey()
            . $firstSubset->getSubsetString()
        );
    }
}
