<?php

namespace Bluspark\DgfipDatamatrix;

use DateTimeImmutable;

final class DatamatrixReference
{
    private DateTimeImmutable $exercice;
    private string            $invoiceNumber;
    private string            $emitterCode;
    private string            $establishmentCode;
    private string            $revenueCode;
    private string            $accountantCode;
    private string            $periodeCode;
    private string            $amount;

    public function getExercice(): DateTimeImmutable
    {
        return $this->exercice;
    }

    public function setExercice(DateTimeImmutable $exercice): DatamatrixReference
    {
        $this->exercice = $exercice;
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

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): DatamatrixReference
    {
        $this->amount = $amount;
        return $this;
    }
}
