<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    public function test_validate_transaction_success(): void
    {
        $response = $this->getJson('/validate-transaction');

        $response->assertStatus(200)
            ->assertJson(['isValid' => false]);
    }

    public function test_validate_transaction_invalid_deviation(): void
    {
        config(['app.transaction_deviation' => 150]);

        $response = $this->getJson('/validate-transaction');

        $response->assertStatus(400)
            ->assertJson([
                'error' => 'Validation failed',
                'message' => 'Deviation must be between 0 and 100.'
            ]);
    }
}
