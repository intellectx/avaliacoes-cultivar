<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GroupIndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserIndexController;
use Illuminate\Support\Facades\Route;

// App
Route::get('/dashboard')->name('dashboard')->uses(DashboardController::class);

// Auth
Route::get('/login')->name('login')->uses(LoginController::class);
Route::get('/forgot-password')->name('forgot-password')->uses(ForgotPasswordController::class);
Route::get('/reset-password')->name('reset-password')->uses(ResetPasswordController::class);

// User
Route::get('/users')->name('user-index')->uses(UserIndexController::class);

// Group
Route::get('/groups')->name('group-index')->uses(GroupIndexController::class);
