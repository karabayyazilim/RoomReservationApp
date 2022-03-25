<?php

namespace App\Services;

use App\Models\Room;
use App\Models\RoomAccessRole;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RoomService
{
    public function store($request)
    {
        DB::transaction(function () use ($request) {
            if ($request->primary) {
                Room::where('primary', true)->update(['primary' => false]);
            }
            $room = Room::create([
                'name' => $request->name,
                'primary' => $request->primary,
            ]);
            if ($request->normal_user) {
                RoomAccessRole::create([
                    'room_id' => $room->id,
                    'role_id' => User::NORMAL,
                ]);
            }
            if ($request->community_user) {
                RoomAccessRole::create([
                    'room_id' => $room->id,
                    'role_id' => User::COMMUNITY,
                ]);
            }
            RoomAccessRole::create([
                'room_id' => $room->id,
                'role_id' => User::ADMIN,
            ]);
        });
    }

    public function update($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            if ($request->primary) {
                Room::where('primary', true)->update(['primary' => false]);
            }

            $room = Room::find($id);
            $room->name = $request->name;
            isset($request->primary) ? $room->primay = $request->primary : null;
            $room->save();

            $roomAccessRole = RoomAccessRole::where('room_id', $id)->first();
            isset($request->normal_user) ? $roomAccessRole->updateOrCreate(['room_id' => $id, 'role_id' => User::NORMAL]) : null;
            isset($request->community_user) ? $roomAccessRole->updateOrCreate(['room_id' => $id, 'role_id' => User::COMMUNITY]) : null;
            !isset($request->normal_user) ? $roomAccessRole->where('role_id', User::NORMAL)->delete() : null;
            !isset($request->community_user) ? $roomAccessRole->where('role_id', User::COMMUNITY)->delete() : null;
        });
    }

    public function destroy($id)
    {
        Room::find($id)->delete();
        RoomAccessRole::where('room_id', $id)->delete();
    }
}
