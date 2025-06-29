<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/test.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'verify-email' => \App\Http\Middleware\VerifyEmail::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        $middleware->redirectTo(function ($request) {
            if (! $request->expectsJson()) {
                return route('login.create'); // نام جدید روت لاگین
            }
        });
        $middleware->validateCsrfTokens(except: [
            'payment/saman/verify',
            'aparat/upload',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'Page not found.',
            ], 404);
        });
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
