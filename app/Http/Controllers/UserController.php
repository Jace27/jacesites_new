<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authenticate(Request $request): array
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        $credentials['blocked'] = false;

        if (Auth::attempt($credentials, $request->get('remember_me', false))) {
            $request->session()->regenerate();

            return ['status' => 'success', 'user' => $request->user()];
        }

        return ['status' => 'error', 'message' => 'Неверный логин или пароль'];
    }

    public function logout(Request $request)
    {
        \auth()->logout();
        return redirect('/');
    }
}
