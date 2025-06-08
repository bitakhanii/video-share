<?php

namespace App\Providers;

use App\Events\TicketReplid;
use App\Events\UserRegistered;
use App\Events\VideoCreated;
use App\Listeners\ChangeTicketStatus;
use App\Listeners\CreateThumbnail;
use App\Listeners\ProcessVideo;
use App\Listeners\SendEmail;
use App\Listeners\SendVerificationEmail;
use App\Models\Comment;
use App\Models\Topic\Reply;
use App\Models\Topic\Topic;
use App\Models\Topic\UserStat;
use App\Observers\ReplyObserver;
use App\Observers\TopicObserver;
use App\Observers\UserObserver;
use App\Observers\UserStatObserver;
use App\Support\Coupon\DiscountManager;
use App\Models\Like;
use App\Models\User;
use App\Models\Video;
use App\Observers\LikeObserver;
use App\Observers\VideoObserver;
use App\Policies\VideoPolicy;
use App\Support\Basket\Basket;
use App\Support\Cost\BasketCost;
use App\Support\Cost\Contracts\CostInterface;
use App\Support\Cost\DiscountCost;
use App\Support\Cost\PackCost;
use App\Support\Cost\ShippingCost;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use Illuminate\Auth\Access\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\Browsershot\Browsershot;
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

        Event::listen(
            TicketReplid::class,
            ChangeTicketStatus::class,
        );

        Route::bind('likeable_id', function ($value, $route) {
            $model_name = 'App\\Models\\'. ucfirst($route->parameters['likeable_type']);
            $routeKey = (new $model_name)->getRouteKeyName();
            return $model_name::where($routeKey, $value)->firstOrFail();
        });

        Like::observe(LikeObserver::class);
        Video::observe(VideoObserver::class);
        User::observe(UserObserver::class);
        Topic::observe(TopicObserver::class);
        Reply::observe(ReplyObserver::class);
        UserStat::observe(UserStatObserver::class);

        Gate::policy(Video::class, VideoPolicy::class);

        /*Gate::define('edit-video', function (User $user, Video $video) {
            return $user->id == $video->user_id;
        });*/

        $this->app->bind(StorageInterface::class, function ($app) {
            return new SessionStorage('cart');
        });

        $this->app->bind(CostInterface::class, function ($app) {
            $basketCost = new BasketCost($app->make(Basket::class));
            $shippingCost = new ShippingCost($basketCost);
            $packCost = new PackCost($shippingCost);
            $discountCost = new DiscountCost($packCost, $app->make(DiscountManager::class), $basketCost);
            return $discountCost;
        });
    }
}
