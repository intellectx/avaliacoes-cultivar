<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GroupIndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserIndexController;
use Illuminate\Support\Facades\Route;

// App
Route::get('/dashboard')->name('dashboard.page')->uses(DashboardController::class);

// Auth
Route::get('/login')->name('login.page')->uses(LoginController::class);
Route::post('/login/auth')->name('authenticate')->uses(AuthenticateController::class);
Route::get('/forgot-password')->name('forgot-password.page')->uses(ForgotPasswordController::class);
Route::get('/reset-password')->name('reset-password.page')->uses(ResetPasswordController::class);

// User
Route::get('/system/users')->name('users.page')->uses(UserIndexController::class);

// Group
Route::get('/system/groups')->name('groups.page')->uses(GroupIndexController::class);
