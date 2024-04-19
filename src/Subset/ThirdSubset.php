<?php

namespace Bluspark\DgfipDatamatrix\Subset;

class ThirdSubset extends Subset
{
    protected const BANK_ESTABLISHMENT_CODE = '0001'; // Fixed value

    public function __construct(
        public string $emitterCode,
    ) {
    }

    public function getSubsetString(): string
    {
        return $this->emitterCode . self::BANK_ESTABLISHMENT_CODE;
    }
}
