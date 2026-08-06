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

Route::prefix('v1')->group(function () {
    Route::apiResource('videos', VideoController::class)->names('api.videos');
});

Route::prefix('v1')->group(function () {
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

