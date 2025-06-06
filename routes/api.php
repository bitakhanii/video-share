<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ArticleController;
use App\Http\Controllers\Api\V2\AuthController as V2AuthController;
use App\Http\Controllers\Api\V1\VideoController;
use App\Http\Controllers\Api\V1\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1/videos')->group(function () {
    Route::get('{video:slug}', [VideoController::class, 'show']);
    Route::get('/', [VideoController::class, 'index']);
    Route::post('/', [VideoController::class, 'store'])->middleware('auth:sanctum');
    Route::put('{video:slug}', [VideoController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('{video:slug}', [VideoController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::prefix('v1/auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('v1')->group(function () {
    Route::resource('articles', ArticleController::class);
});

Route::prefix('v2/auth')->group(function () {
        Route::post('login', [V2AuthController::class, 'login']);
        Route::post('logout', [V2AuthController::class, 'logout']);
        Route::post('refresh', [V2AuthController::class, 'refresh']);
        Route::post('me', [V2AuthController::class, 'me']);
});

