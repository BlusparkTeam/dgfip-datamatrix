<?php

namespace Bluspark\DgfipDatamatrix\Tests\Subset;

use Bluspark\DgfipDatamatrix\Subset\DebtorNumber;
use PHPUnit\Framework\TestCase;

class DebtorNumberTest extends TestCase
{
    public function testSubsetString(): void
    {
       $this->assertSame('000000000002456', (new DebtorNumber(
           new \DateTime('2024-01-01'),
           '2456',
           '09',
       ))->getSubsetString());
    }

    public function testSubsetKey(): void
    {
        $this->assertSame('12', (new DebtorNumber(
            new \DateTime('2024-01-01'),
            '2456',
            '09',
        ))->getSubsetKey());
    }

    /**
     * Reference sample: debt number 210382, fiscal year 2026, period 1. The optical line
     * carries `0119000000000210382` — key `01` belongs to subset 2 as a whole, `19` is the
     * `Cle2` computed here.
     */
    public function testMatchesTheReferenceSample(): void
    {
        $debtNumber = new DebtorNumber(new \DateTime('2026-07-16'), '210382', '1');

        $this->assertSame('000000000210382', $debtNumber->getSubsetString());
        $this->assertSame('19', $debtNumber->getSubsetKey());
    }
}
