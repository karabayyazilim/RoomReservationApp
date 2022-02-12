<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;

class EventService
{
    public function store($request)
    {
        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'room_id' => $request->room_id,
            'user_id' => auth()->id(),
        ]);
    }

    public function update($request, $id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'room_id' => $request->room_id,
        ]);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if (auth()->user()->role != User::ADMIN ) {
            $user = User::where('id', auth()->id())->first();
            if ($user->id != $event->user_id) {
                abort(403);
            } else {
                $event->delete();
            }
        } else {
            $event->delete();
        }

    }
}
