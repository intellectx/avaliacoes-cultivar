<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class GroupIndexController extends Controller
{
    public function index(): Response
    {
        /** @var LengthAwarePaginator $data */
        $data = Group::paginate(50);

        return Inertia::render('group/Group', [
            'data' => $data->items(),
            'pagination' => [
                'totalItems' => $data->total(),
                'totalPages' => $data->lastPage(),
                'currentPage' => $data->currentPage()
            ]
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('group/Form', [
            'meta' => [
                'context' => 'create'
            ]
        ]);
    }

    public function update($id): Response
    {
        return Inertia::render('group/Form', [
            'record' => Group::find($id),
            'meta' => [
                'context' => 'update'
            ]
        ]);
    }

    public function store($id)
    {
        if ($id) {
            $record = Group::find($id);
            $record->name = Request::post('name');
            $record->active = Request::post('active');
            $record->save();

            return Redirect::route('groups.page');
        }

        Group::create(
            Request::validate(['name' => ['required', 'max:50']])
        );

        return Redirect::route('groups.page');
    }
}
