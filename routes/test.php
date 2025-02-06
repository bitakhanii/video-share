<?php

use App\Events\VideoCreated;
use App\Exceptions\InvalidTypeException;
use App\Http\Controllers\IndexController;
use App\Jobs\Otp;
use App\Mail\UserRegistered;
use App\Models\Video;
use App\Notifications\VideoProcessed;
use App\Services\FFmpegAdapter;
use App\Services\Notification\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

Route::get('/tst', [IndexController::class, 'test'])->name('test');
Route::get('/email', function () {
    $user = User::first();
    return Mail::to('bita@gmail.com')->send(new VerifyEmailMail($user));
});
Route::get('generate', function () {
    echo URL::temporarySignedRoute('verify', now()->addSecond(10), ['id' => 4]);
});
Route::get('verify/{id}', function () {
    dd(request()->hasValidSignature());
    //echo 'verify4';
})->name('verify');

Route::get('/queue', function () {
    Otp::dispatch();
});
Route::get('event', function () {
    $video = Video::first();
    VideoCreated::dispatch($video);
});
Route::get('notify', function () {
    $user = User::first();
    $video = Video::first();
    $user->notify(new VideoProcessed);
});
Route::get('file', function () {
    // return response()->file(storage_path('app/private/adv.jpg'));
    $content = Storage::get('adv.jpg');
    return Response::make($content)->header('content-type', 'image/jpg');
});
Route::get('duration', function () {
    $path = 'CQdfMG06o2SKy4Bx9B9lkKNgUeZhQOjf2T7YXZqd.mp4';
    $ffmpeg = new FFmpegAdapter($path);

    dd($ffmpeg->getDuration());
});
Route::get('frame', function () {
    $path = 'CQdfMG06o2SKy4Bx9B9lkKNgUeZhQOjf2T7YXZqd.mp4';
    $ffmpeg = new FFmpegAdapter($path);
    $ffmpeg->getThumbnail();
});

Route::get('log', function () {
    $video = Video::first()->name;
   Log::info('This is a log!', [$video]);
});

Route::get('exception', function () {
    throw new InvalidTypeException();
});

Route::get('notification', function () {
   Mail::to('moeinsadeghi@gmail.com')->send(new UserRegistered());
});

Route::get('send-email', function () {
    $notification = resolve(Notification::class);
    $notification->sendEmail(User::query()->find(31), new UserRegistered());
});

Route::get('send-sms', function () {
    $notification = resolve(Notification::class);
    $notification->sendSms(User::query()->find(16), 'Hello');
});

Route::get('send-tel', function () {
    $notification = resolve(Notification::class);
    $notification->sendTel(User::query()->find(11), 'Telegram Test');
});
