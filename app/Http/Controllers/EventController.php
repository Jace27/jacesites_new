<?php

namespace App\Http\Controllers;

use App\Events\PublicEvent;
use App\Events\UserEvent;
use App\Models\Events;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function publicEvent(Request $request)
    {
        if (!is_null($event = $request->input('event'))) {
            event(new PublicEvent(auth()->id(), $event));
        }
    }

    public function userEvent(Request $request)
    {
        if (!is_null($event = $request->input('event')) && !is_null($user = $request->input('user'))) {
            $user = User::query()->where('id', '=', $user)->orWhere('name', '=', $user)->firstOrFail();
            event(new UserEvent($user->id, $event));
        }
    }

    public function getUnseenImportantEvents(Request $request)
    {
        Events::fireUnseenImportant();
    }
}
