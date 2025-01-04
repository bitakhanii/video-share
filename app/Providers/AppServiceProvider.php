<?php

namespace App\Providers;

use App\Events\VideoCreated;
use App\Listeners\CreateThumbnail;
use App\Listeners\ProcessVideo;
use App\Listeners\SendEmail;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Video;
use App\Observers\LikeObserver;
use App\Observers\VideoObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use function Psy\bin;

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

        Route::bind('likeable_id', function ($value, $route) {
            $model_name = 'App\\Models\\'. ucfirst($route->parameters['likeable_type']);
            $routeKey = (new $model_name)->getRouteKeyName();
            return $model_name::where($routeKey, $value)->firstOrFail();
        });

        Like::observe(LikeObserver::class);
        Video::observe(VideoObserver::class);
    }
}
