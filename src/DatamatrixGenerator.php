<?php

namespace Bluspark\DgfipDatamatrix;

use Bluspark\DgfipDatamatrix\Exception\MalformedEnsemble;

class DatamatrixGenerator
{
    public const DOCUMENT_CODE            = '9'; // Fixed value

    public const BANK_ESTABLISHMENT_CODE = '0001'; // Fixed value

    public const NATURE_CODE = '8'; // Fixed value

    public const BANK_PROCESSING_CODE = '06'; // Fixed value

    public const APPLICATION_CODE = '4'; // Fixed value

    public function generateDatamatrix(DatamatrixReference $datamatrixReference): DgfipDatamatrix
    {
        $donneesMetiers = str_repeat(' ', 40);
        $spaceZone = str_repeat(' ', 24);

        $invoiceAmount = $datamatrixReference->amount;

        if (strlen($datamatrixReference->amount) < 2) {
            $invoiceAmount = str_repeat('0', 3 - strlen($invoiceAmount)).$invoiceAmount;
        }

        $ensemble6 = $datamatrixReference->establishmentCode
            .$datamatrixReference->periodeCode
            .$datamatrixReference->revenueCode
            .'00'
            .$datamatrixReference->fiscalYear->format('y')
        ;

        $ensemble3 = $datamatrixReference->emitterCode.self::BANK_ESTABLISHMENT_CODE;

        $numDebtor = '00'
            .$datamatrixReference->fiscalYear->format('Y')
            .str_repeat('0', 9 - strlen($datamatrixReference->invoiceNumber))
            .$datamatrixReference->invoiceNumber
        ;

        $ensemble2 = $this->generateNumDebtorKey(
            $datamatrixReference->fiscalYear,
            (int) $datamatrixReference->periodeCode,
            (int) $numDebtor,
        )
            .$numDebtor
            .$datamatrixReference->accountantCode
            .self::APPLICATION_CODE
            .self::DOCUMENT_CODE
        ;

        $ensemble1 = self::NATURE_CODE
            .self::BANK_PROCESSING_CODE
            .' '
            .str_repeat(' ', 8 - strlen($invoiceAmount))
            .$invoiceAmount
        ;

        $ensemble1SpacePos = strpos($ensemble1, ' ');

        if ($ensemble1SpacePos === false) {
            throw MalformedEnsemble::create($ensemble1, '1');
        }

        return new DgfipDatamatrix(
            $donneesMetiers
            .$spaceZone
            .$ensemble6
            .$this->generateEnsemble6Key($ensemble6)
            .$ensemble3
            .$this->generateBase100Key($ensemble3)
            .' '
            .$this->generateBase100Key($ensemble2)
            .$ensemble2
            .$this->generateBase100Key(str_replace(' ', '0', substr_replace($ensemble1, '', $ensemble1SpacePos, 1)))
            .$ensemble1
        );
    }

    private function generateEnsemble6Key(string $ensemble6): string
    {
        $key = 11 - (int)$ensemble6 % 11;

        return (string) match ($key) {
            10 => 0,
            11 => 1,
            default => $key,
        };
    }

    private function generateBase100Key(string $subject): string
    {
        $subjectArray = array_reverse(str_split($subject));

        $result = 0;

        foreach ($subjectArray as $rank => $value) {
            $result += (int) $value * ($rank + 1);
        }

        return (string)($result % 100);
    }

    private function generateNumDebtorKey(\DateTimeInterface $exercice, int $codePeriode, int $numDebtor): string
    {
        $key = (
            (
                (int)$exercice->format('y')
                + $codePeriode
                + $numDebtor
            ) % 23
        )
            + 1
        ;

        return (string)($key < 10 ? '0'.$key : $key);
    }
}
