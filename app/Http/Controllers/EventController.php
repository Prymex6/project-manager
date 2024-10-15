<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\EventRequest;
use App\Models\Event;
use App\Services\EventService;

class EventController extends Controller
{
    private EventService $eventService;

    public function __construct(EventService $service)
    {
        $this->eventService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = $this->eventService->all();

        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $this->eventService->create($request);

        return response()->json('The event has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event = $this->eventService->get($event);

        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        $this->eventService->update($request, $event);

        return response()->json('The event has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->eventService->delete($event);

        return response()->json('The event has been deleted!', 200);
    }
}
