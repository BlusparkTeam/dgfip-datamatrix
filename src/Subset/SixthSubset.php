<?php

namespace Bluspark\DgfipDatamatrix\Subset;

class SixthSubset extends Subset
{
    public function __construct(
        public string $establishmentCode,
        public string $periodCode,
        public string $revenueCode,
        public \DateTimeInterface $fiscalYear,
    ) {
        
    }
    
    public function getSubsetString(): string
    {
        return $this->establishmentCode
            . $this->periodCode
            . $this->revenueCode
            . '00'
            . $this->fiscalYear->format('y');
    }
    
    public function getSubsetKey(): string
    {
        $key = 11 - ((int)$this->getSubsetString()) % 11;

        return (string)match ($key) {
            10 => 0,
            11 => 1,
            default => $key,
        };
    }
}
