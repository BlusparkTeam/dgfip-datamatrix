<?php

namespace Bluspark\DgfipDatamatrix\Tests\Subset;

use Bluspark\DgfipDatamatrix\Subset\ThirdSubset;
use PHPUnit\Framework\TestCase;

class ThirdSubsetTest extends TestCase
{
    public function testSubsetString(): void
    {
       $this->assertSame('0420001', (new ThirdSubset('042'))->getSubsetString());
    }

    public function testSubsetKey(): void
    {
        $this->assertSame('35', (new ThirdSubset('042'))->getSubsetKey());
    }
}
