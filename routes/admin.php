<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReplyController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['guest:web', 'guest:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('register', [AdminController::class, 'registerForm'])
        ->name('register.form');

    Route::post('register', [AdminController::class, 'register'])
        ->name('register');

    Route::get('login', [AdminController::class, 'loginForm'])
        ->name('login.form');

    Route::post('login', [AdminController::class, 'login'])
        ->name('login');
});

Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::prefix('panel')->middleware(['auth', 'role:editor,admin'])->group(function () {
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

Route::middleware('auth:web,admin')->prefix('tickets')->group(function () {

    Route::get('/', [TicketController::class, 'index'])
        ->name('tickets.index');

    Route::get('/create', [TicketController::class, 'create'])
        ->name('tickets.create');

    Route::post('/', [TicketController::class, 'store'])
        ->name('tickets.store');

    Route::get('/{ticket:title}', [TicketController::class, 'show'])
        ->name('tickets.show');

    Route::post('{ticket}/reply', ReplyController::class)
        ->name('reply.store');

    Route::get('{ticket}/close', [TicketController::class, 'close'])
        ->name('tickets.close');
});
