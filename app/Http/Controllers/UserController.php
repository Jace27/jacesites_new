<?php

namespace App\Http\Controllers;

use App\Events\PublicEvent;
use App\Models\Events;
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
            Events::fire(Events::USER_LOGIN, [
                'type' => 'user-login',
                'name' => $credentials['name']
            ], PublicEvent::class, null, true);
            return ['status' => 'success', 'user' => $request->user()];
        }

        return ['status' => 'error', 'message' => 'Неверный логин или пароль'];
    }

    public function logout(Request $request)
    {
        Events::fire(Events::USER_LOGOUT, [
            'type' => 'user-logout',
            'name' => \auth()->user()?->name,
        ]);
        \auth()->logout();
        return redirect('/');
    }
}
