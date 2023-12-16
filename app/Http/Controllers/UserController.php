<?php

namespace App\Http\Controllers;

use App\Events\PublicEvent;
use App\Models\Events;
use App\Models\Options;
use App\Models\OptionsValues;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function avatarUpload(Request $request)
    {
        if (is_null($changer = \auth()->user()))
            return ['status' => 'error', 'message' => 'Недостаточно прав'];

        $changing = User::whereName($request->input('user'))->first();
        if ($changing == null) return ['status' => 'error', 'message' => 'Недостаточно прав'];

        if ($changer->id != $changing->id) {
            return ['status' => 'error', 'message' => 'Недостаточно прав'];
        }

        move_uploaded_file($request->file('avatar')->getRealPath(), $_SERVER['DOCUMENT_ROOT'] . '/images/users/' . $changing->name . '.png');

        Events::fire(Events::CHANGED_AVATAR);

        return ['status' => 'success'];
    }

    public function optionsChange(Request $request)
    {
        if (is_null($changer = \auth()->user()))
            return ['status' => 'error', 'message' => 'Недостаточно прав'];

        $changing = User::whereName($request->input('user'))->first();
        if ($changing == null) return ['status' => 'error', 'message' => 'Недостаточно прав'];

        if ($changer->id != $changing->id) {
            return ['status' => 'error', 'message' => 'Недостаточно прав'];
        }

        $options = $request->input();
        foreach ($options as $key => $option) {
            if ($key == 'user') continue;
            if ($key == 'old_password') continue;
            if ($key == 'password') {
                if (trim($option) != '') {
                    if (password_verify($request->input('old_password'), $changing->password)) {
                        $changing->password = password_hash($option, PASSWORD_BCRYPT);
                        $changing->save();
                        Events::fire(Events::CHANGED_PASSWORD);
                    }
                }
                continue;
            }
            $key = str_replace('_', ' ', $key);
            if (!str_contains($key, '-hidden')) {
                $o = Options::query()->where('name', $key)->first();
                if ($o == null) continue;
                $value = OptionsValues::query()->where([['option_id', $o->id], ['user_id', $changing->id]])->first();
                if (is_null($value)) {
                    $value = new OptionsValues();
                    $value->option_id = $o->id;
                    $value->user_id = $changing->id;
                }
                Events::fire(Events::CHANGED_PROFILE, ['option' => $key, 'old_value' => $value->value, 'new_value' => $option]);
                $value->value = $option;
                $value->save();
            } else {
                $key = explode('-', $key)[0];
                $o = Options::query()->where('name', $key)->first();
                $value = OptionsValues::query()->where([['option_id', $o->id], ['user_id', $changing->id]])->first();
                if (!is_null($value)) {
                    $value->hidden = $option;
                    $value->save();
                }
            }
        }

        return ['status' => 'success'];
    }

    public function passwordFlush(Request $request, int $id)
    {
        if (is_null($changer = \auth()->user()))
            return ['status' => 'error', 'message' => 'Недостаточно прав'];

        if (is_null($user = User::whereId($id)->first()))
            return ['status' => 'error', 'message' => 'Пользователь не найден'];

        if ($changer->id != $user->id)
            return ['status' => 'error', 'message' => 'Недостаточно прав'];

        $password = Str::random(12);
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();

        Events::fire(Events::CHANGED_PASSWORD);

        return [
            'status' => 'success',
            'password' => $password,
        ];
    }
}
