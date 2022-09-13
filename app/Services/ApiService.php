<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class ApiService
{
    public function generateToken($code)
    {
        $res = Http::post('https://api.intra.42.fr/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => env('INTRA_CLIENT_ID'),
            'client_secret' => env('INTRA_SECRET_ID'),
            'code' => $code,
            'redirect_uri' => 'http://193.140.63.89:8080/intra/callback'
	]);
        self::getUser($res);
        self::getEvent($res);
    }

    public function getUser($res)
    {
        $response = Http::withToken($res['access_token'])
            ->get('https://api.intra.42.fr/v2/me');
        self::storeUser($response->body());
    }

    public function getEvent($res)
    {
        $response = Http::withToken($res['access_token'])
            ->get('https://api.intra.42.fr/v2/campus/49/events');
        self::storeEvent($response->body());
    }

    public function storeUser($response)
    {
        $data = json_decode($response);
        $user = User::where('email', $data->email)->first();
        if (isset($user)) {
            $role = $user->role;
            $user->update([
                'name' => $data->displayname,
                'email' => $data->email,
                'password' => Hash::make(rand()),
                'avatar' => $data->image_url,
                'role' => $data->{"staff?"} == true ? User::ADMIN : $role
            ]);
        } else {
            $user = User::create([
                'name' => $data->displayname,
                'email' => $data->email,
                'password' => Hash::make(rand()),
                'avatar' => $data->image_url,
                'role' => $data->{"staff?"} == true ? User::ADMIN : User::NORMAL
            ]);
        }
        auth()->loginUsingId($user->id);
    }

    public function storeEvent($res)
    {
        $data = self::eventArr(json_decode($res));
        $room = Room::where('primary', true)->first();
        $user = User::where('role', User::ADMIN)->first();
        foreach ($data as $item) {
            $event = isRoomTaken($room->id, $item['start_date'], $item['end_date']);
            if ($event == true)
                isRoomTakenDelete($room->id, $item['start_date'], $item['end_date']);
            Event::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'start_date' => $item['start_date'],
                'end_date' =>$item['end_date'],
                'room_id' => $room->id,
                'user_id' => $user->id,
            ]);
        }
    }

    public function eventArr($events): array
    {
        $arr = [];
        foreach ($events as $event) {
            if (($event->kind == 'meet_up' || $event->kind == 'conference' || $event->kind == 'workshop') && $event->begin_at > now()) {
                array_push($arr, [
                    'name' => $event->name,
                    'description' => $event->description,
                    'start_date' => date('Y-m-d H:i:s', strtotime($event->begin_at)),
                    'end_date' => date('Y-m-d H:i:s', strtotime($event->end_at)),
                ]);
            }
        }
        return $arr;
    }
}