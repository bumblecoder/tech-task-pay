<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\Request;
use App\DTO\Transaction;
use App\Services\RequestMoneyValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use InvalidArgumentException;

final class TransactionController extends Controller
{
    public function __construct(private readonly RequestMoneyValidator $validator)
    {
    }

    public function validateTransaction(): JsonResponse
    {
        try {
            $userRequest = Request::create(10000, 'USD');
            $transaction = Transaction::create(9000, 'USD');

            $isValid = $this->validator->validate($userRequest, $transaction);

            return response()->json(['isValid' => $isValid]);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
