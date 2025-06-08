<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AparatController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryVideoController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Topic\BadgeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\Topic\ReplyController as TopicReplyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Topic\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::post('videos', [VideoController::class, 'store'])->name('videos.store');
Route::get('videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
Route::post('videos/{video}', [VideoController::class, 'update'])->name('videos.update');
Route::get('categories/{category:slug}/videos', [CategoryVideoController::class, 'index'])->name('categories.videos.index');
Route::post('videos/{video}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('{likeable_type}/{likeable_id}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::get('{likeable_type}/{likeable_id}/dislike', [DislikeController::class, 'store'])->name('dislikes.store');
    Route::get('notification/email', [NotificationController::class, 'email'])->name('notification.email');
    Route::post('notification/email', [NotificationController::class, 'sendEmail'])->name('notification.email.send');
    Route::get('notification/sms', [NotificationController::class, 'sms'])->name('notification.sms');
    Route::post('notification/sms', [NotificationController::class, 'sendSms'])->name('notification.sms.send');
    Route::post('coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');
    Route::get('coupon/remove', [CouponController::class, 'remove'])->name('coupon.remove');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}/invoice', [OrderController::class, 'downloadInvoice'])->name('orders.invoice');
    Route::get('orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::get('files', [FileController::class, 'index'])->name('file.index');
    Route::get('file/create', [FileController::class, 'create'])->name('file.create');
    Route::post('file/new', [FileController::class, 'new'])->name('file.new');
    Route::get('file/{file}', [FileController::class, 'download'])->name('file.download');
    Route::get('file/{file}/delete', [FileController::class, 'delete'])->name('file.delete');
});

Route::prefix('panel')->middleware('role:admin')->group(function () {
    Route::get('users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::post('users/{user}/update', [UserController::class, 'update'])
        ->name('users.update');

    Route::get('roles', [RoleController::class, 'index'])
        ->name('roles.index');

    Route::post('roles', [RoleController::class, 'store'])
        ->name('roles.store');

    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit');

    Route::post('roles/{role}', [RoleController::class, 'update'])
        ->name('roles.update');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products.index');
});

Route::get('basket/add/{product}', [BasketController::class, 'addToBasket'])
    ->name('basket.add');

Route::get('basket', [BasketController::class, 'index'])
    ->name('basket.index');

Route::post('basket/update/{product}', [BasketController::class, 'updateQuantity'])
    ->name('basket.update');

Route::get('basket/delete/{product}', [BasketController::class, 'delete'])
    ->name('basket.delete');

Route::middleware('auth')->get('basket/checkout', [BasketController::class, 'checkoutForm'])
    ->name('basket.checkout.form');

Route::middleware('auth')->post('basket/checkout', [BasketController::class, 'checkout'])
    ->name('basket.checkout');

Route::post('payment/{gateway}/verify', [PaymentController::class, 'verify'])
    ->name('payment.verify');

Route::middleware(['guest:web', 'guest:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [AdminController::class, 'registerForm'])->name('register.form');
    Route::post('register', [AdminController::class, 'register'])->name('register');
    Route::get('login', [AdminController::class, 'loginForm'])->name('login.form');
    Route::post('login', [AdminController::class, 'login'])->name('login');
});

Route::middleware('auth:web,admin')->prefix('tickets')->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/{ticket:title}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('{ticket}/reply', [ReplyController::class, 'store'])->name('reply.store');
    Route::get('{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
});

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

Route::get('logout', function () {
    auth()->logout();
});

Route::get('admin/logout', function () {
    auth()->guard('admin')->logout();
});

require __DIR__ . '/auth.php';
