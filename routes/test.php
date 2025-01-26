<?php

use Illuminate\Support\Facades\Route;

Route::get('/tst', [IndexController::class, 'test'])->name('test');
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

Route::get('log', function () {
    $video = \App\Models\Video::first()->name;
   \Illuminate\Support\Facades\Log::info('This is a log!', [$video]);
});

Route::get('exception', function () {
    throw new \App\Exceptions\InvalidTypeException();
});
