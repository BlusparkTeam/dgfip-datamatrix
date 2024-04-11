<?php

namespace Bluspark\DgfipDatamatrix\Exception;

class DatamatrixFunctionImageCreateDoesNotExists extends DatamatrixException
{
    public function __construct(int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("The function 'imagecreate' isn't defined.", $code, $previous);
    }
}
