<?php

use App\Http\Controllers\CategoryVideoController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\VerifyEmail;
use App\Mail\VerifyEmail as VerifyEmailMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use FFMpeg\FFMpeg;

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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('{likeable_type}/{likeable_id}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::get('{likeable_type}/{likeable_id}/dislike', [DislikeController::class, 'store'])->name('dislikes.store');
});

require __DIR__ . '/auth.php';


/* Test Routes */
Route::get('/test', [IndexController::class, 'test'])->name('test');
Route::get('/email', function () {
    $user = \App\Models\User::first();
    return Mail::to('bita@gmail.com')->send(new VerifyEmailMail($user));
});
Route::get('generate', function () {
    echo \Illuminate\Support\Facades\URL::temporarySignedRoute('verify', now()->addSecond(10), ['id' => 4]);
});
Route::get('verify/{id}', function () {
    dd(request()->hasValidSignature());
    //echo 'verify4';
})->name('verify');

Route::get('/queue', function () {
    \App\Jobs\Otp::dispatch();
});
Route::get('event', function () {
    $video = \App\Models\Video::first();
    \App\Events\VideoCreated::dispatch($video);
});
Route::get('notify', function () {
    $user = \App\Models\User::first();
    $video = \App\Models\Video::first();
    $user->notify(new \App\Notifications\VideoProcessed);
});
Route::get('file', function () {
    // return response()->file(storage_path('app/private/adv.jpg'));
    $content = \Illuminate\Support\Facades\Storage::get('adv.jpg');
    return \Illuminate\Support\Facades\Response::make($content)->header('content-type', 'image/jpg');
});
Route::get('duration', function () {
    $path = 'CQdfMG06o2SKy4Bx9B9lkKNgUeZhQOjf2T7YXZqd.mp4';
    $ffmpeg = new \App\Services\FFmpegAdapter($path);

    dd($ffmpeg->getDuration());
});
Route::get('frame', function () {
    $path = 'CQdfMG06o2SKy4Bx9B9lkKNgUeZhQOjf2T7YXZqd.mp4';
    $ffmpeg = new \App\Services\FFmpegAdapter($path);
    $ffmpeg->getThumbnail();
});
