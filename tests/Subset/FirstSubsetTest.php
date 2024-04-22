<?php

namespace Bluspark\DgfipDatamatrix\Tests\Subset;

use Bluspark\DgfipDatamatrix\Subset\FirstSubset;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FirstSubsetTest extends TestCase
{
    #[DataProvider('provideTestSubsetString')]
    public function testSubsetString(int $amountInCent, string $expectedString): void
    {
       $this->assertSame($expectedString, (new FirstSubset($amountInCent))->getSubsetString());
    }

    #[DataProvider('provideTestSubsetKey')]
    public function testSubsetKey(int $amountInCent, string $expectedKey): void
    {
        $this->assertSame($expectedKey, (new FirstSubset($amountInCent))->getSubsetKey());
    }

    public static function provideTestSubsetString(): \Generator
    {
        yield [1, '806      001'];
        yield [10, '806      010'];
        yield [100, '806      100'];
        yield [1000, '806     1000'];
    }

    public static function provideTestSubsetKey(): \Generator
    {
        yield [1, '43'];
        yield [10, '44'];
        yield [100, '45'];
        yield [1000, '46'];
    }
}
