<?php

namespace App\Http\Controllers;

use App\Events\PublicEvent;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function publicEvent(Request $request)
    {
        if (!is_null($event = $request->input('event'))) {
            event(new PublicEvent($event));
        }
    }
}
