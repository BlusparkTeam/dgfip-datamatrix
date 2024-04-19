<?php

namespace Bluspark\DgfipDatamatrix\Tests\Subset;

use Bluspark\DgfipDatamatrix\Subset\SecondSubset;
use PHPUnit\Framework\TestCase;

class SecondSubsetTest extends TestCase
{

    public function testSubsetString(): void
    {
       $this->assertSame('190020240000013452349', (new SecondSubset(
           new \DateTime('first day of 2024'),
           '06',
           '1345',
           '23',
       ))->getSubsetString());
    }

    public function testSubsetKey(): void
    {
        $this->assertSame('33', (new SecondSubset(
            new \DateTime('first day of 2024'),
            '06',
            '1345',
            '23',
        ))->getSubsetKey());
    }

}
