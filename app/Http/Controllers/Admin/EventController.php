<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Room;
use App\Models\User;
use App\Services\EventService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;

class EventController extends Controller
{
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.event.index', [
            'events' => User::ADMIN == auth()->user()->role ? Event::latest()->get() : Event::where('user_id', auth()->id())->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create', [
            'rooms' => Room::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\EventRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EventRequest $request)
    {
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
	$isEventDate = isRoomTaken($request->room_id, $start_date, $end_date);
	$request->flash();
        if ($start_date > $end_date || $start_date == $end_date || now() > $start_date) {
            return redirect()->back()->withErrors('Başlangıç tarihi bitiş tarihinden büyük, küçük veya eşit olamaz');
        }
        if ($start_date->diffInHours($end_date) > 2 && auth()->user()->role != User::ADMIN) {
            return redirect()->back()->withErrors("2 Saat'ten fazla olamaz");
        }
        if ($isEventDate === true) {
            return redirect()->back()->withErrors('Etkinlik tarihi zaten alınmış');
        }
        $this->eventService->store($request);
        return redirect()->route('admin.event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if (User::ADMIN == auth()->user()->role) {
            return view('admin.event.update', [
                'event' => $event,
                'rooms' => Room::all()
            ]);
        } else {
            if ($event->user_id == auth()->id()) {
                return view('admin.event.update', [
                    'event' => $event,
                    'rooms' => Room::all()
                ]);
            } else {
                abort(403);
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\EventRequest $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $isEventDate = isRoomTaken($request->room_id, $start_date, $end_date);
        $request->flash();
        if (str_replace('T', ' ', $request->start_date) > str_replace('T', ' ', $request->end_date) || $start_date == $end_date) {
            return redirect()->back()->withErrors('Başlangıç tarihi bitiş tarihinden büyük, küçük veya eşit olamaz');
        }
        if ($start_date->diffInHours($end_date) > 2) {
            return redirect()->back()->withErrors("2 Saat'ten fazla olamaz");
        }
        if ($isEventDate === true && auth()->id() == $event->user_id && $request->room_id == $event->room_id) {
            return redirect()->back()->withErrors('Etkinlik tarihi zaten alınmış');
        }
        $this->eventService->update($request, $event->id);
        return redirect()->route('admin.event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->eventService->destroy($event->id);
        return redirect()->route('admin.event.index');
    }
}