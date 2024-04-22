<?php

namespace Bluspark\DgfipDatamatrix\Subset;

class DebtorNumber extends Subset
{
    public function __construct(
        public \DateTimeInterface $fiscalYear,
        public string $invoiceNumber,
        public string $periodCode,
    ) {

    }

    public function getSubsetString(): string
    {
        return '00'
            .$this->fiscalYear->format('Y')
            . str_pad($this->invoiceNumber, 9, '0', STR_PAD_LEFT)
        ;
    }

    public function getSubsetKey(): string
    {
        $key = (
                (
                    (int)$this->fiscalYear->format('y')
                    + (int)$this->periodCode
                    + (int)$this->getSubsetString()
                ) % 23
            )
            + 1;

        return (string)($key < 10 ? '0' . $key : $key);
    }
}
