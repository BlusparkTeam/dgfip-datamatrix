<?php

namespace Bluspark\DgfipDatamatrix\Subset;

abstract class Subset
{
    abstract public function getSubsetString(): string;

    public function getSubsetKey(): string
    {
        $subjectArray = array_reverse(str_split($this->getSubsetString()));

        $result = 0;

        foreach ($subjectArray as $rank => $value) {
            $result += (int)$value * ($rank + 1);
        }

        return (string)($result % 100);
    }
}
