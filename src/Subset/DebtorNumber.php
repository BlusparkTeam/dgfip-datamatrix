<?php

namespace Bluspark\DgfipDatamatrix\Subset;

/**
 * Application-specific part of subset 2, for the Hélios PES V2 ORMC layout.
 *
 * Specification: "Cahier des charges TIPSEPA et Talon 2 lignes" v1.6, §C.1.2 — the 17 characters
 * that depend on the application are, for Hélios PES V2 ORMC (formerly ROLMRE EAU):
 *
 *   - 15 characters: the `NumDette` tag, right-aligned and zero-padded;
 *   - 2 characters : the `Cle2` tag of the `Pièce` block, transcoded into digits.
 *
 * `Cle2` is itself defined by `Class_TitreAller.xsd` as a modulo 23 computed on the
 * CONCATENATION of the last two digits of the fiscal year, the period and the 15-character
 * debt number — not on their sum.
 *
 * `NumDette` is the debt number the issuer assigns to the debtor; in Hélios it matches the
 * invoice number of the roll article, hence the constructor argument name.
 */
class DebtorNumber extends Subset
{
    private const DEBT_NUMBER_LENGTH = 15;

    public function __construct(
        public \DateTimeInterface $fiscalYear,
        public string $invoiceNumber,
        public string $periodCode,
    ) {

    }

    public function getSubsetString(): string
    {
        return str_pad($this->invoiceNumber, self::DEBT_NUMBER_LENGTH, '0', STR_PAD_LEFT);
    }

    public function getSubsetKey(): string
    {
        $key = (int)(
            $this->fiscalYear->format('y')
            . $this->periodCode
            . $this->getSubsetString()
        ) % 23 + 1;

        return str_pad((string)$key, 2, '0', STR_PAD_LEFT);
    }
}
