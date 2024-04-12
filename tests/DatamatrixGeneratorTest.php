<?php

namespace Bluspark\DgfipDatamatrix\Tests;

use Bluspark\DgfipDatamatrix\DatamatrixGenerator;
use Bluspark\DgfipDatamatrix\DatamatrixReference;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DatamatrixGeneratorTest extends TestCase
{
    #[DataProvider('provideGenerateDatamatrixReference')]
    public function testGenerateDatamatrixReference($expected, DatamatrixReference $reference): void
    {
        $datamatrixGenerator = new DatamatrixGenerator();
        $datamatrix = $datamatrixGenerator->generate($reference);
        $this->assertSame($expected, $datamatrix->asString());
    }

    public function testShouldNotGenerateDatamatrixFromIncompleteDataset(): void
    {
        $datamatrixGenerator = new DatamatrixGenerator();
        $reference = (new DatamatrixReference)
            ->setFiscalYear(new DateTimeImmutable('2024-01-01'))
            ->setInvoiceNumber('1234')
            // ->setEmitterCode('940033') <- missing
            ->setEstablishmentCode('004')
            ->setRevenueCode('093')
            ->setAccountantCode('035031')
            ->setPeriodeCode('0');


        $this->expectException(InvalidArgumentException::class);
        $datamatrixGenerator->generate($reference);
    }
    public function testShouldBeAbleToGetSvgRepresentation(): void
    {
        $datamatrixGenerator = new DatamatrixGenerator();
        $reference = (new DatamatrixReference)
            ->setFiscalYear(new DateTimeImmutable('2024-01-01'))
            ->setInvoiceNumber('1234')
            ->setEmitterCode('940033')
            ->setEstablishmentCode('004')
            ->setRevenueCode('093')
            ->setAccountantCode('035031')
            ->setAmountInCents(10000)
            ->setPeriodeCode('0');


        $datamatrix = $datamatrixGenerator->generate($reference);
        $this->assertStringStartsWith('<?xml', $datamatrix->asSvg());
    }

    public static function provideGenerateDatamatrixReference(): array
    {
        return [
            [
                '                                                                004009300241940033000160 28170020240000012340350314947806    10000',
                (new DatamatrixReference)
                    ->setFiscalYear(new DateTimeImmutable('2024-01-01'))
                    ->setInvoiceNumber('1234')
                    ->setEmitterCode('940033')
                    ->setEstablishmentCode('004')
                    ->setRevenueCode('093')
                    ->setAccountantCode('035031')
                    ->setPeriodeCode('0')
                    ->setAmountInCents(10000),

            ],
        ];
    }
}
