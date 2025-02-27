<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MagicLoginController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register.create');

    Route::post('register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login.create');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('redirect/{provider}', [SocialController::class, 'redirect'])
        ->name('provider.redirect');

    Route::get('{provider}/callback', [SocialController::class, 'callback'])
        ->name('provider.callback');

    Route::get('login/magic', [MagicLoginController::class, 'create'])
        ->name('login.magic.create');

    Route::post('login/magic', [MagicLoginController::class, 'store'])
        ->name('login.magic.store');

    Route::get('login/magic/{token}', [MagicLoginController::class, 'login'])
        ->name('login.magic.login');

    Route::get('login/two-factor-auth', [TwoFactorAuthController::class, 'loginForm'])
        ->name('login.two-factor-auth.form');

    Route::post('login/two-factor-auth', [TwoFactorAuthController::class, 'login'])
        ->name('login.two-factor-auth');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::prefix('two-factor-auth')->name('two-factor-auth.')->group(function () {
       Route::get('/', [TwoFactorAuthController::class, 'index'])
           ->name('index');

       Route::get('/send-code', [TwoFactorAuthController::class, 'sendCode'])
           ->name('send-code');

        Route::get('/enter-code', [TwoFactorAuthController::class, 'enterCode'])
            ->name('enter-code');

        Route::post('/activate', [TwoFactorAuthController::class, 'activate'])
            ->name('activate');

       Route::post('deactivate', [TwoFactorAuthController::class, 'deactivate'])
           ->name('deactivate');
    });
});

Route::middleware('web')->group(function () {
    Route::get('two-factor-auth/resent', [TwoFactorAuthController::class, 'resent'])
        ->name('two-factor-auth.resent');
});
