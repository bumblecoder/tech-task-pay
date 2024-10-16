<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\DTO\Request;
use App\DTO\Transaction;
use App\Services\RequestMoneyValidator;
use InvalidArgumentException;
use Tests\TestCase;

class RequestMoneyValidatorTest extends TestCase
{
    public function test_validate_currency_mismatch(): void
    {
        $request = Request::create(10000, 'USD');
        $transaction = Transaction::create(10000, 'EUR');
        $validator = new RequestMoneyValidator(10);

        $this->assertFalse($validator->validate($request, $transaction));
    }

    public function test_validate_within_deviation(): void
    {
        $request = Request::create(9500, 'USD');
        $transaction = Transaction::create(9000, 'USD');

        $validator = new RequestMoneyValidator(10);

        $this->assertTrue($validator->validate($request, $transaction));
    }

    public function test_validate_outside_deviation(): void
    {
        $request = Request::create(10000, 'USD');
        $transaction = Transaction::create(9000, 'USD');

        $validator = new RequestMoneyValidator(5);

        $this->assertFalse($validator->validate($request, $transaction));
    }

    public function test_validate_exact_amount(): void
    {
        $request = Request::create(10000, 'USD');
        $transaction = Transaction::create(10000, 'USD');
        $validator = new RequestMoneyValidator(10);

        $this->assertTrue($validator->validate($request, $transaction));
    }

    public function test_validate_small_deviation(): void
    {
        $request = Request::create(9950, 'USD');
        $transaction = Transaction::create(10000, 'USD');

        $validator = new RequestMoneyValidator(1);

        $this->assertTrue($validator->validate($request, $transaction));
    }

    public function test_negative_deviation_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Deviation must be between 0 and 100.');

        $request = Request::create(10000, 'USD');
        $transaction = Transaction::create(9000, 'USD');
        $validator = new RequestMoneyValidator(-5);

        $validator->validate($request, $transaction);
    }
}
