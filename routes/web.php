<?php

use App\Http\Controllers\AparatController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Checkout\CouponController;
use App\Http\Controllers\Checkout\OrderController;
use App\Http\Controllers\Checkout\PaymentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Front\BasketController;
use App\Http\Controllers\Front\CategoryVideoController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\DislikeController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\LikeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\VideoController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Topic\BadgeController;
use App\Http\Controllers\Topic\ReplyController as TopicReplyController;
use App\Http\Controllers\Topic\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)
    ->name('index');

Route::get('search', SearchController::class)
    ->name('videos.search');

Route::resource('videos', VideoController::class)
    ->except(['index']);

Route::get('categories/{category:slug}/videos', CategoryVideoController::class)
    ->name('categories.videos.index');

Route::get('{likeable_type}/{likeable_id}/like', LikeController::class)
    ->name('likes.store');

Route::get('{likeable_type}/{likeable_id}/dislike', DislikeController::class)
    ->name('dislikes.store');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('videos/{video}/comments', CommentController::class)
        ->name('comments.store');

    Route::prefix('profile')->name('profile.')->group(function () {

        Route::get('/', [ProfileController::class, 'edit'])
            ->name('edit');

        Route::patch('/', [ProfileController::class, 'update'])
            ->name('update');

        Route::delete('/', [ProfileController::class, 'destroy'])
            ->name('destroy');
    });

    Route::prefix('notification')->name('notification.')->group(function () {

        Route::get('/email', [NotificationController::class, 'email'])
            ->name('email');

        Route::post('/email', [NotificationController::class, 'sendEmail'])
            ->name('email.send');

        Route::get('/sms', [NotificationController::class, 'sms'])
            ->name('sms');

        Route::post('/sms', [NotificationController::class, 'sendSms'])
            ->name('sms.send');
    });

    Route::get('basket/checkout', [BasketController::class, 'checkoutForm'])
        ->name('basket.checkout.form');

    Route::post('basket/checkout', [BasketController::class, 'checkout'])
        ->name('basket.checkout');

    Route::post('coupon/apply', [CouponController::class, 'apply'])
        ->name('coupon.apply');

    Route::get('coupon/remove', [CouponController::class, 'remove'])
        ->name('coupon.remove');

    Route::prefix('orders')->name('orders.')->group(function () {

        Route::get('/', [OrderController::class, 'index'])
            ->name('index');

        Route::get('{order}/invoice', [OrderController::class, 'downloadInvoice'])
            ->name('invoice');

        Route::get('{order}/pay', [OrderController::class, 'pay'])
            ->name('pay');
    });

    Route::prefix('files')->name('files.')->group(function () {
        Route::get('/', [FileController::class, 'index'])
            ->name('index');

        Route::get('create', [FileController::class, 'create'])
            ->name('create');

        Route::post('upload', [FileController::class, 'upload'])
            ->name('upload');

        Route::get('{file}', [FileController::class, 'download'])
            ->name('download');

        Route::get('{file}/delete', [FileController::class, 'delete'])
            ->name('delete');
    });
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products.index');
});

Route::prefix('basket')->name('basket.')->group(function () {

    Route::post('add/{product}', [BasketController::class, 'addToBasket'])
        ->name('add');

    Route::get('/', [BasketController::class, 'index'])
        ->name('index');

    Route::post('update/{product}', [BasketController::class, 'updateQuantity'])
        ->name('update');

    Route::get('delete/{product}', [BasketController::class, 'delete'])
        ->name('delete');
});

Route::post('payment/{gateway}/verify', [PaymentController::class, 'verify'])
    ->name('payment.verify');

Route::middleware('web')->prefix('aparat')->group(function () {
    Route::get('/', [AparatController::class, 'index'])->name('aparat.index');
    Route::get('login', [AparatController::class, 'login'])->name('aparat.login');
    Route::post('upload', [AparatController::class, 'upload'])->name('aparat.upload');
    Route::get('show', [AparatController::class, 'show'])->name('aparat.show');
    Route::get('delete', [AparatController::class, 'delete'])->name('aparat.delete');
});

Route::middleware(['web', 'auth'])->prefix('topics')->group(function () {
    Route::get('/', [TopicController::class, 'index'])->name('topics.index');
    Route::get('/create', [TopicController::class, 'create'])->name('topics.create');
    Route::post('/', [TopicController::class, 'store'])->name('topics.store');
    Route::get('/{topic}', [TopicController::class, 'show'])->name('topics.show');
    Route::post('/{topic}/reply', [TopicReplyController::class, 'store'])
        ->name('topic_reply.store');
});

Route::middleware('auth')->prefix('badges')->group(function () {
    Route::get('/', [BadgeController::class, 'create'])->name('badges.create');
    Route::post('/store', [BadgeController::class, 'store'])->name('badges.store');
});

Route::middleware('auth')->prefix('chat')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('chat.index');
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('messages', [MessageController::class, 'store'])->name('message.store');
});

Route::get('logout', function () {
    auth()->logout();
});

require __DIR__ . '/auth.php';
