<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GroupIndexController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // App
    Route::get('/')->name('dashboard.page')->uses(DashboardController::class);
    Route::get('/dashboard')->name('dashboard.page');

    // Groups
    Route::prefix('/system/groups')->group(function () {
        Route::get('/')->name('groups.page')->uses(GroupIndexController::class . '@index');
        Route::get('/create')->name('groups-create.page')->uses(GroupIndexController::class . '@create');
        Route::post('/')->name('groups-create')->uses(GroupIndexController::class . '@store');

        Route::get('/update/{id}')
            ->name('group-update.page')
            ->uses(GroupIndexController::class . '@update')
            ->where('id', '[0-9]+');

        Route::put('/{id}')
            ->name('groups-update')
            ->uses(GroupIndexController::class . '@store')
            ->where('id', '[0-9]+');

        Route::delete('/{id}')
            ->name('groups-delete')
            ->uses(GroupIndexController::class . '@delete')
            ->where('id', '[0-9]+');
    });
});

// Auth
Route::get('/forgot-password')->name('forgot-password.page')->uses(ForgotPasswordController::class);
Route::get('/reset-password')->name('reset-password.page')->uses(ResetPasswordController::class);

// User
Route::get('/system/users')
    ->name('users.page')
    ->uses(UserIndexController::class)
    ->middleware('auth');
