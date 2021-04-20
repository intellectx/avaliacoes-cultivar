<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ForgotPasswordController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('auth/ForgotPassword');
    }
}
