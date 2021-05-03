<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Inertia\Inertia;
use Inertia\Response;

class GroupIndexController extends Controller
{
    public function __invoke(): Response
    {
        $data = Group::all()->sortBy('name')->values();

        return Inertia::render('group/Group', [
            'data' => $data
        ]);
    }
}
