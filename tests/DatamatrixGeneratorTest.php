<?php

namespace Bluspark\DgfipDatamatrix\Tests;

use Bluspark\DgfipDatamatrix\DatamatrixGenerator;
use Bluspark\DgfipDatamatrix\DatamatrixReference;
use jucksearm\barcode\Datamatrix;
use PHPUnit\Framework\TestCase;
/**
 * @group billing
 */
class DatamatrixGeneratorTest extends TestCase
{
    public function testGenerateDatamatrixReference(): void
    {
        $datamatrixGenerator = new DatamatrixGenerator();

        $this->assertSame(
            Datamatrix::factory()
                      ->setMargin(0)
                      ->setCode('                                                                004009300241940033000160 28170020240000012340350314947806    10000')
                      ->getDatamatrixSvgData(),
            $datamatrixGenerator->generateDatamatrix(
                (new DatamatrixReference())
                    ->setExercice(new \DateTimeImmutable('01/01/2024'))
                    ->setInvoiceNumber('1234')
                    ->setAmount('10000')
                    ->setEmitterCode('940033')
                    ->setEstablishmentCode('004')
                    ->setRevenueCode('093')
                    ->setPeriodeCode('0')
                    ->setAccountantCode('035031')
            )->asSvg()
        );
    }
}
