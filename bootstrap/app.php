<?php

use App\Http\Middleware\Authorization;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        //-----------Define Custom Routes--------------------------
        then: function(){
            Route::middleware(['web','auth','auth.role:2'])
                ->prefix('company')
                ->as('company.')
                ->group(base_path('routes/company.php'));

            Route::middleware(['web','auth','auth.role:1'])
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.role' => Authorization::class,
        ]);
        // Add your SSLCommerz routes here
        $middleware->validateCsrfTokens(except: [
            'sslcommerz/success',
            'sslcommerz/fail',
            'sslcommerz/cancel',
            'sslcommerz/ipn',
            'sslcommerz/pay-via-ajax',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
