<?php

namespace Bluspark\DgfipDatamatrix\Subset;

abstract class Subset
{
    abstract public function getSubsetString(): string;

    /**
     * Modulo 100 key, as defined in §C.3 of the "TIPSEPA et Talon 2 lignes" specification:
     * sum of each digit multiplied by its rank counted from the right, then the last two digits.
     *
     * Always two characters: a key below ten is left-padded with a zero. Without it, every
     * subset whose key is single-digit shortens the whole line by one character and shifts
     * everything that follows.
     */
    public function getSubsetKey(): string
    {
        $subjectArray = array_reverse(str_split($this->getSubsetString()));

        $result = 0;

        foreach ($subjectArray as $rank => $value) {
            $result += (int)$value * ($rank + 1);
        }

        return str_pad((string)($result % 100), 2, '0', STR_PAD_LEFT);
    }
}
