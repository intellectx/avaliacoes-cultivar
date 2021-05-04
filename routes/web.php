<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('/forgot-password')->name('forgot-password.page')->uses(ForgotPasswordController::class);
Route::get('/reset-password')->name('reset-password.page')->uses(ResetPasswordController::class);

Route::middleware(['auth'])->group(function () {
    // App
    Route::get('/')->name('dashboard.page')->uses(DashboardController::class);
    Route::get('/dashboard')->name('dashboard.page')->uses(DashboardController::class);

    // Groups
    Route::prefix('/system/groups')->group(function () {
        Route::get('/')->name('groups.page')->uses(GroupController::class . '@index');
        Route::get('/create')->name('groups-create.page')->uses(GroupController::class . '@create');
        Route::post('/')->name('groups-create')->uses(GroupController::class . '@store');

        Route::get('/update/{id}')
            ->name('group-update.page')
            ->uses(GroupController::class . '@update')
            ->where('id', '[0-9]+');

        Route::put('/{id}')
            ->name('groups-update')
            ->uses(GroupController::class . '@store')
            ->where('id', '[0-9]+');

        Route::match(['post', 'delete'], '/{id}')
            ->name('groups-delete')
            ->uses(GroupController::class . '@delete')
            ->where('id', '[0-9]+');
    });

    // Users
    Route::prefix('/system/users')->group(function () {
        Route::get('/')->name('users.page')->uses(UserController::class . '@index');
        Route::get('/create')->name('users-create.page')->uses(UserController::class . '@create');
        Route::post('/')->name('users-create')->uses(UserController::class . '@store');

        Route::get('/update/{id}')
            ->name('user-update.page')
            ->uses(UserController::class . '@update')
            ->where('id', '[0-9]+');

        Route::put('/{id}')
            ->name('users-update')
            ->uses(UserController::class . '@store')
            ->where('id', '[0-9]+');

        Route::match(['post', 'delete'], '/{id}')
            ->name('users-delete')
            ->uses(UserController::class . '@delete')
            ->where('id', '[0-9]+');
    });
});
