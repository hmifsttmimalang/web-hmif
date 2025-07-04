<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('drive:dispatch-user-photo-jobs')->dailyAt('01:00');
        $schedule->command('queue:work --stop-when-empty')->everyMinute();
        $schedule->command('drive:dispatch-user-photo-jobs')->dailyAt('01:00');
        $schedule->command('db:backup')->dailyAt('02:00');
        $schedule->command('queue:restart')->dailyAt('03:00');
    })
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
        $middleware->alias([
            'superadmin' => \App\Http\Middleware\checkRole::class,
            'admin' => \App\Http\Middleware\checkRole::class,
            'check.registration.period' => \App\Http\Middleware\CheckRegistrationPeriod::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
