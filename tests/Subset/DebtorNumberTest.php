<?php

namespace Bluspark\DgfipDatamatrix\Tests\Subset;

use Bluspark\DgfipDatamatrix\Subset\DebtorNumber;
use PHPUnit\Framework\TestCase;

class DebtorNumberTest extends TestCase
{
    public function testSubsetString(): void
    {
       $this->assertSame('002024000002456', (new DebtorNumber(
           new \DateTime('first day of 2024'),
           '2456',
           '09',
       ))->getSubsetString());
    }

    public function testSubsetKey(): void
    {
        $this->assertSame('06', (new DebtorNumber(
            new \DateTime('first day of 2024'),
            '2456',
            '09',
        ))->getSubsetKey());
    }
}
