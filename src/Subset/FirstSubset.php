<?php

namespace Bluspark\DgfipDatamatrix\Subset;

use Bluspark\DgfipDatamatrix\Exception\MalformedEnsemble;

class FirstSubset extends Subset
{
    protected const NATURE_CODE = '8'; // Fixed value

    protected const BANK_PROCESSING_CODE = '06'; // Fixed value

    public function __construct(
        public int $amountInCents,
    ) {
    }

    public function getSubsetString(): string
    {
        $invoiceAmount = str_pad((string)$this->amountInCents, 3, '0', STR_PAD_LEFT);

        return self::NATURE_CODE
            . self::BANK_PROCESSING_CODE
            . ' '
            . str_repeat(' ', 8 - strlen($invoiceAmount))
            . $invoiceAmount
            ;
    }

    public function getSubsetKey(): string
    {
        $subsetString = $this->getSubsetString();

        $ensemble1SpacePos = strpos($subsetString, ' ');

        if ($ensemble1SpacePos === false) {
            throw MalformedEnsemble::create($subsetString, '1');
        }

        return $this->generateBase100Key(str_replace(
            ' ',
            '0',
            substr_replace($subsetString, '', $ensemble1SpacePos, 1),
        ));
    }

    private function generateBase100Key(string $subject): string
    {
        $subjectArray = array_reverse(str_split($subject));

        $result = 0;

        foreach ($subjectArray as $rank => $value) {
            $result += (int)$value * ($rank + 1);
        }

        return (string)($result % 100);
    }
}
