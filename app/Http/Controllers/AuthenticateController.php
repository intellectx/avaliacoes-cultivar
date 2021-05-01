<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

final class AuthenticateController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|filled|max:50|email',
            'password' => 'required|filled'
        ]);

        /** @var User $user */
        $user = User::where('email', $request->get('email'))->first();

        if (is_null($user)) {
            return Redirect::back()->withErrors([
                'email' => 'validation.wrongEmail'
            ]);
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            return Redirect::back()->withErrors([
                'password' => 'validation.wrongPassword'
            ]);
        }

        return Redirect::route('dashboard.page');
    }
}
