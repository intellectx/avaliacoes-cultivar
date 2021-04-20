<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class GroupIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('group/Group');
    }
}
