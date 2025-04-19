<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Events\VideoCreated;
use App\Listeners\CreateThumbnail;
use App\Listeners\ProcessVideo;
use App\Listeners\SendEmail;
use App\Listeners\SendVerificationEmail;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use App\Models\Video;
use App\Observers\LikeObserver;
use App\Observers\VideoObserver;
use App\Policies\VideoPolicy;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use Illuminate\Auth\Access\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
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

        Event::listen(
            UserRegistered::class,
            SendVerificationEmail::class,
        );

        Route::bind('likeable_id', function ($value, $route) {
            $model_name = 'App\\Models\\'. ucfirst($route->parameters['likeable_type']);
            $routeKey = (new $model_name)->getRouteKeyName();
            return $model_name::where($routeKey, $value)->firstOrFail();
        });

        Like::observe(LikeObserver::class);
        Video::observe(VideoObserver::class);

        Gate::policy(Video::class, VideoPolicy::class);

        /*Gate::define('edit-video', function (User $user, Video $video) {
            return $user->id == $video->user_id;
        });*/

        $this->app->bind(StorageInterface::class, function ($app) {
            return new SessionStorage('cart');
        });
    }
}
