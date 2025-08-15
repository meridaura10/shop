<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Console\Handler as ScheduleHandler;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withSchedule(new ScheduleHandler())
    ->withEvents(discover: [
        __DIR__.'/../app/Events',
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(['admin' => App\Http\Middleware\AdminCheckMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
