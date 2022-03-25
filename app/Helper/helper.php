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

