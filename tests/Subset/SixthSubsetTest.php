<?php

namespace Bluspark\DgfipDatamatrix\Tests\Subset;

use Bluspark\DgfipDatamatrix\Subset\SixthSubset;
use PHPUnit\Framework\TestCase;

class SixthSubsetTest extends TestCase
{
    public function testSubsetString(): void
    {
       $this->assertSame('04204930024', (new SixthSubset(
           '042',
           '04',
           '93',
           new \DateTime('2024-01-01'),
       ))->getSubsetString());
    }

    public function testSubsetKey(): void
    {
        $this->assertSame('2', (new SixthSubset(
            '042',
            '04',
            '93',
            new \DateTime('2024-01-01'),
        ))->getSubsetKey());
    }
}
