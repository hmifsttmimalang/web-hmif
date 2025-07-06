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
        $schedule->command('drive:dispatch-upload-user-photos')
            ->dailyAt('01:00')
            ->appendOutputTo(storage_path('logs/drive-upload.log'));

        $schedule->command('db:backup')
            ->dailyAt('02:00')
            ->appendOutputTo(storage_path('logs/db-backup.log'));

        $schedule->command('queue:restart')
            ->dailyAt('03:00');

        $schedule->command('backup:cleanup')
            ->dailyAt('04:00')
            ->appendOutputTo(storage_path('logs/cleanup-backup.log'));

        $schedule->command('queue:work --stop-when-empty')
            ->everyMinute()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/queue-worker.log'));
    })
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\TrustProxies::class,
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
