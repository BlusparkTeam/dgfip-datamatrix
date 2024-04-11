<?php

namespace Bluspark\DgfipDatamatrix;

use DateTimeImmutable;

class DatamatrixReference
{
    public function __construct(
        public DateTimeImmutable $fiscalYear,
        public string            $invoiceNumber,
        public string            $emitterCode,
        public string            $establishmentCode,
        public string            $revenueCode,
        public string            $accountantCode,
        public string            $periodeCode,
        public string            $amount,
    ) {

    }
}
