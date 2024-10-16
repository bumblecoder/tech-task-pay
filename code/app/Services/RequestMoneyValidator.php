<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\Request;
use App\DTO\Transaction;
use InvalidArgumentException;

final readonly class RequestMoneyValidator
{
    public function __construct(private int $deviation)
    {
        if ($deviation < 0 || $deviation > 100) {
            throw new InvalidArgumentException('Deviation must be between 0 and 100.');
        }
    }

    public function validate(Request $request, Transaction $transaction): bool
    {
        if ($request->getCurrency() !== $transaction->getCurrency()) {
            return false;
        }

        $deviationPercentage = (string) ($this->deviation / 100);
        $deviationAmount = $transaction->getAmount()->multiply($deviationPercentage);

        $minAmount = $transaction->getAmount()->subtract($deviationAmount);
        $maxAmount = $transaction->getAmount()->add($deviationAmount);

        return $request->getAmount()->greaterThanOrEqual($minAmount)
            && $request->getAmount()->lessThanOrEqual($maxAmount);
    }
}
