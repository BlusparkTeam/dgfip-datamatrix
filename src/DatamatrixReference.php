<?php

namespace Bluspark\DgfipDatamatrix;

use DateTimeImmutable;

class DatamatrixReference
{
    protected ?DateTimeImmutable $fiscalYear;
    protected  string  $invoiceNumber = "";
    protected  string  $emitterCode = "";
    protected  string  $establishmentCode = "";
    protected  string  $revenueCode = "";
    protected  string  $accountantCode = "";
    protected  string  $periodeCode = "";
    protected  int     $amountInCents = 0;

    public function getFiscalYear(): ?DateTimeImmutable
    {
        return $this->fiscalYear;
    }

    public function setFiscalYear(?DateTimeImmutable $fiscalYear): DatamatrixReference
    {
        $this->fiscalYear = $fiscalYear;
        return $this;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): DatamatrixReference
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function getEmitterCode(): string
    {
        return $this->emitterCode;
    }

    public function setEmitterCode(string $emitterCode): DatamatrixReference
    {
        $this->emitterCode = $emitterCode;
        return $this;
    }

    public function getEstablishmentCode(): string
    {
        return $this->establishmentCode;
    }

    public function setEstablishmentCode(string $establishmentCode): DatamatrixReference
    {
        $this->establishmentCode = $establishmentCode;
        return $this;
    }

    public function getRevenueCode(): string
    {
        return $this->revenueCode;
    }

    public function setRevenueCode(string $revenueCode): DatamatrixReference
    {
        $this->revenueCode = $revenueCode;
        return $this;
    }

    public function getAccountantCode(): string
    {
        return $this->accountantCode;
    }

    public function setAccountantCode(string $accountantCode): DatamatrixReference
    {
        $this->accountantCode = $accountantCode;
        return $this;
    }

    public function getPeriodeCode(): string
    {
        return $this->periodeCode;
    }

    public function setPeriodeCode(string $periodeCode): DatamatrixReference
    {
        $this->periodeCode = $periodeCode;
        return $this;
    }

    public function getAmountInCents(): int
    {
        return $this->amountInCents;
    }

    public function setAmountInCents(int $amountInCents): DatamatrixReference
    {
        $this->amountInCents = $amountInCents;
        return $this;
    }

    public function isComplete(): bool
    {
        return $this->fiscalYear !== null
            && $this->invoiceNumber !== ''
            && $this->emitterCode !== ''
            && $this->establishmentCode !== ''
            && $this->revenueCode !== ''
            && $this->accountantCode !== ''
            && $this->periodeCode !== ''
            && $this->amountInCents > 0;
    }


}
