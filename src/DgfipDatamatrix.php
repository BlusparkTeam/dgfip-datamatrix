<?php

namespace Bluspark\DgfipDatamatrix;

use Bluspark\DgfipDatamatrix\Exception\DatamatrixFunctionImageCreateDoesNotExists;
use jucksearm\barcode\Datamatrix;
use jucksearm\barcode\lib\DatamatrixFactory;

class DgfipDatamatrix
{
    public function __construct(
        private readonly string $code,
        private readonly int $margin = 0,
    ) {
    }

    public function asHtml(): string
    {
        return $this->initFactory()
                  ->setCode($this->code)
                  ->getDatamatrixHtmlData()
        ;
    }

    public function asPng(): string
    {
        return $this->initFactory()
                    ->setCode($this->code)
                    ->getDatamatrixPngData()
            ?? throw new DatamatrixFunctionImageCreateDoesNotExists()
        ;
    }

    public function asSvg(): string
    {
        return $this->initFactory()
                    ->setCode($this->code)
                    ->getDatamatrixSvgData()
        ;
    }

    private function initFactory(): DatamatrixFactory
    {
        if (!class_exists('jucksearm\barcode\datamatrix')) {
            throw new \RuntimeException('please install jucksearm/php-barcode first.');
        }

        return Datamatrix::factory()
                  ->setMargin($this->margin)
        ;
    }

    public function asString(): string
    {
        return $this->code;
    }
}
