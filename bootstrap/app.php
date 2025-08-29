<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Console\Handler as ScheduleHandler;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('webhooks')
                ->name('webhooks.')
                ->group(base_path('routes/webhooks.php'));
        },
    )
    ->withSchedule(new ScheduleHandler())
    ->withEvents(discover: [
        __DIR__.'/../app/Events',
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => App\Http\Middleware\AdminCheckMiddleware::class,
            'checkout' => App\Http\Middleware\CheckoutMiddleware::class,
            'auth.optional' => \App\Http\Middleware\OptionalAuth::class,
        ]);

        $middleware->prependToGroup('api', ['auth.optional:sanctum']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
