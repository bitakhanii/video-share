<?php

use App\Http\Controllers\CategoryVideoController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
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
})->middleware(['auth', 'verify-email'])->name('dashboard');

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

require __DIR__ . '/auth.php';
