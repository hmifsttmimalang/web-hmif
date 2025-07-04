<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDriveService;
use Masbug\Flysystem\GoogleDriveAdapter as FlysystemGoogleDriveAdapter;
use Illuminate\Filesystem\FilesystemAdapter as LaravelFilesystemAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share('currentUser', function () {
            return Auth::user();
        });
        Vite::prefetch(concurrency: 3);
        Carbon::setLocale('id');
        Storage::extend('google', function ($app, $config) {
            $client = new GoogleClient();
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);

            $service = new GoogleDriveService($client);
            $adapter = new FlysystemGoogleDriveAdapter($service, $config['folderId'] ?? null);

            $flysystem = new Filesystem($adapter);

            return new LaravelFilesystemAdapter(
                $flysystem,
                $adapter,
                $config
            );
        });
    }
}
