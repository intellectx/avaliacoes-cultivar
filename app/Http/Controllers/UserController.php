<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $data = User::with(['group'])->paginate(50);

        return Inertia::render('user/User', [
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
        $groups = Group::select(['id', 'name'])
            ->where('active', 1)
            ->orderBy('name')
            ->get()
            ->toArray();

        return Inertia::render('user/Form', [
            'groups' => $groups,
            'meta' => [
                'context' => 'create'
            ]
        ]);
    }

    public function update($id): Response
    {
        $groups = Group::select(['id', 'name'])
            ->where('active', 1)
            ->orderBy('name')
            ->get()
            ->toArray();

        return Inertia::render('user/Form', [
            'groups' => $groups,
            'record' => User::find($id),
            'meta' => [
                'context' => 'update'
            ]
        ]);
    }

    public function store(?string $id = null)
    {
        if ($id) {
            $record = User::find($id);
            $record->name = Request::post('name');
            $record->email = Request::post('email');
            $record->group_id = Request::post('groupId');
            $record->active = Request::post('active');
            $record->password = Hash::make(Request::post('password'));
            $record->save();

            Request::session()->flash('success', 'general.updateMessage');
            return Redirect::route('users.page');
        }

        User::create(
            Request::validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'email'],
                'group_id' => ['required'],
                'active' => ['required', 'boolean'],
                'password' => ['required'],
            ])
        );

        Request::session()->flash('success', 'general.createMessage');
        return Redirect::route('users.page');
    }

    public function delete($id)
    {
        if (!$id) {
            return Redirect::refresh(400);
        }

        User::destroy($id);

        Request::session()->flash('success', 'general.deleteMessage');
        return Redirect::route('users.page');
    }
}
