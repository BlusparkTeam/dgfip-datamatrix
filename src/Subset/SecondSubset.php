<?php

namespace Bluspark\DgfipDatamatrix\Subset;

class SecondSubset extends Subset
{
    protected const APPLICATION_CODE = '4'; // Fixed value

    protected const DOCUMENT_CODE = '9'; // Fixed value

    public function __construct(
        public \DateTimeInterface $fiscalYear,
        public string $periodCode,
        public string $invoiceNumber,
        public string $accountantCode,
    ) {
    }

    public function getSubsetString(): string
    {
        $debtorNumber = new DebtorNumber(
            fiscalYear: $this->fiscalYear,
            invoiceNumber: $this->invoiceNumber,
            periodCode: $this->periodCode,
        );

        return $debtorNumber->getSubsetKey()
            . $debtorNumber->getSubsetString()
            . $this->accountantCode
            . self::APPLICATION_CODE
            . self::DOCUMENT_CODE;
    }
}
