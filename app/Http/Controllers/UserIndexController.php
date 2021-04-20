<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class UserIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('user/User');
    }
}
