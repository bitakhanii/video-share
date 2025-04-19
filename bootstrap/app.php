<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/test.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['verify-email' => \App\Http\Middleware\VerifyEmail::class]);
        $middleware->alias(['role' => \App\Http\Middleware\RoleMiddleware::class]);
        $middleware->redirectTo(function ($request) {
            if (! $request->expectsJson()) {
                return route('login.create'); // نام جدید روت لاگین
            }
        });
        $middleware->validateCsrfTokens(except: [
            'payment/saman/verify',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        /*$exceptions->reportable(function (\App\Exceptions\InvalidTypeException $e) {
            //abort(404);
        });

        $exceptions->renderable(function (\App\Exceptions\InvalidTypeException $e) {
            return response()->view('welcome');
        });
        $exceptions->reportable(function (Throwable $e) {
            return false;
        });*/
    })->create();
