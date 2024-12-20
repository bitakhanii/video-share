<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
        //web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['verify-email' => \App\Http\Middleware\VerifyEmail::class]);
        $middleware->redirectTo(function ($request) {
            if (! $request->expectsJson()) {
                return route('login.create'); // نام جدید روت لاگین
            }
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
