<?php

declare(strict_types=1);

namespace App\DTO;

use Money\Currency;
use Money\Money;

final readonly class Transaction
{
    private function __construct(private Money $amount)
    {
    }

    public static function create(int $amountInCents, string $currency): self
    {
        return new self(new Money($amountInCents, new Currency(strtoupper($currency))));
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->amount->getCurrency()->getCode();
    }
}
