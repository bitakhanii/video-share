<?php

namespace App\Providers;

use App\Events\VideoCreated;
use App\Listeners\CreateThumbnail;
use App\Listeners\ProcessVideo;
use App\Listeners\SendEmail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

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
        // Paginator::useBootstrapFive();
        Paginator::useBootstrap();

        Event::listen (
            VideoCreated::class,
            SendEmail::class,
        );
        Event::listen (
            VideoCreated::class,
            CreateThumbnail::class,
        );
        Event::listen (
            VideoCreated::class,
            ProcessVideo::class,
        );
    }
}
