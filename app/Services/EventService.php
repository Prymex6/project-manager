<?php

namespace App\Services;

use App\Http\Requests\Event\EventRequest;
use App\Http\Resources\Event\EventIndexResource;
use App\Http\Resources\Event\EventShowResource;
use App\Models\Event;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class EventService
{
    public function all(): AnonymousResourceCollection
    {
        $events = Event::with(['user', 'status'])->paginate(20);

        return EventIndexResource::collection($events);
    }

    public function create(EventRequest $request): void
    {
        $data = [
            'user_id'       => $request->user_id,
            'created_by'    => Auth::user()->id,
            'title'         => $request->title,
            'description'   => $request->description,
            'tags'          => $request->tags,
            'status_id'     => $request->status_id,
            'started_at'    => $request->started_at,
            'ended_at'      => $request->ended_at,
        ];

        Event::create($data);
    }

    public function update(EventRequest $request, Event $event): void
    {
        $event->user_id         = $request->user_id;
        $event->title           = $request->title;
        $event->description     = $request->description;
        $event->tags            = $request->tags;
        $event->status_id       = $request->status_id;
        $event->started_at      = $request->started_at;
        $event->ended_at        = $request->ended_at;

        $event->save();
    }

    public function get(Event $event): EventShowResource
    {
        $event->load(['user', 'creator', 'status']);

        return new EventShowResource($event);
    }

    public function delete(Event $event): void
    {
        $event->delete();
    }
}
