<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\RequestMoneyValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RequestMoneyValidator::class, function ($app) {
            return new RequestMoneyValidator(
                deviation: config('app.transaction_deviation')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
