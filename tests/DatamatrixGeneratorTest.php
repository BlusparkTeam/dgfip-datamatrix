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
            '                                                                004009300241940033000160 28170020240000012340350314947806    10000',
            $datamatrixGenerator->generateDatamatrix(
                new DatamatrixReference(
                    fiscalYear: new \DateTimeImmutable('01/01/2024'),
                    invoiceNumber: '1234',
                    emitterCode: '940033',
                    establishmentCode: '004',
                    revenueCode: '093',
                    accountantCode: '035031',
                    periodeCode: '0',
                    amount: '10000',
                )
            )->asString()
        );
    }
}
