<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/login', function () {
    return Inertia::render('Login');
});

Route::get('/forgot-password', function () {
    return Inertia::render('ForgotPassword');
});

Route::get('/reset-password', function () {
    return Inertia::render('ResetPassword');
});
