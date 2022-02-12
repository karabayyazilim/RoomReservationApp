<?php

use App\Models\Event;
use App\Models\RoomAccessRole;

function whereAccessRoom($room_id, $role_id) {
    return (bool)RoomAccessRole::where('room_id', $room_id)->where('role_id', $role_id)->first();
}

function isRoomTaken($room_id, $start, $end): bool
{
    return (bool)Event::where('room_id', $room_id)
        ->whereBetween('start_date', [$start, $end])
        ->OrWhereBetween('end_date', [$start, $end])
        ->count();
}

function isRoomTakenDelete($room_id, $start, $end): bool
{
    return (bool)Event::where('room_id', $room_id)
        ->whereBetween('start_date', [$start, $end])
        ->OrWhereBetween('end_date', [$start, $end])
        ->delete();
}

/*{
    $a = (bool)Event::where('room_id', $room_id)->where('start_date', '<=', $start_date)->where('end_date', '>=', $end_date)->first();
    dd($room_id, $start_date, $end_date, $a);
}*/

