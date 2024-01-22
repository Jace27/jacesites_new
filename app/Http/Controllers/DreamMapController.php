<?php

namespace App\Http\Controllers;

use App\Models\MapLocations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DreamMapController extends Controller
{
    public function loadMap(string $user)
    {
        $user = User::whereName($user)->get();
        if (count($user) != 1) {
            return ['status' => 'error', 'message' => 'Пользователя не существует'];
        }
        $user = $user[0];

        $locations = [];
        foreach ($user->dreammap_locations()->get() as $location) {
            $locations[] = [
                'id'    => $location->image_id,
                'x'     => $location->x,
                'y'     => $location->y,
                'w'     => $location->w,
                'h'     => $location->h,
                'r'     => $location->r,
                'z'     => $location->z,
                'image' => '/images/dreams/' . $location->image()->first()->record()->id . '/' . $location->image()->first()->filename,
            ];
        }
        return ['status' => 'success', 'locations' => $locations];
    }

    public function saveMap(Request $request)
    {
        if (is_null($user = auth()->user()) || $user->id != $request->input('user_id')) {
            return ['status' => 'error', 'message' => 'Авторизируйтесь для изменения карты'];
        }

        $locations = json_decode($request->input('locations'));
        $count = count(MapLocations::all());
        foreach ($locations as $location) {
            $loc = MapLocations::whereImageId($location->id)->first();
            if ($loc != null) {
                $loc->x = $location->x;
                $loc->y = $location->y;
                $loc->w = $location->w;
                $loc->h = $location->h;
                $loc->r = $location->r;
                $loc->z = $location->z;
                $loc->save();
            } else {
                MapLocations::create([
                    'user_id'  => $request->input('user_id'),
                    'image_id' => $location->id,
                    'x'        => $location->x,
                    'y'        => $location->y,
                    'w'        => $location->w,
                    'h'        => $location->h,
                    'r'        => $location->r,
                    'z'        => $location->z,
                ]);
            }
        }
        if (count(MapLocations::all()) != count($locations)) {
            foreach (MapLocations::all() as $loc_db) {
                $ok = false;
                foreach ($locations as $loc_client) {
                    if ($loc_client->id == $loc_db->image_id) {
                        $ok = true;
                    }
                }
                if (!$ok) {
                    $loc_db->delete();
                }
            }
        }

        return ['status' => 'success'];
    }
}
