<?php

namespace App\Services;

use App\Http\Requests\Ticket\TicketRequest;
use App\Http\Resources\Ticket\TicketIndexResource;
use App\Http\Resources\Ticket\TicketShowResource;
use App\Models\Ticket;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function all(?Project $project = null): AnonymousResourceCollection
    {
        if ($project) {
            $tickets = Ticket::with(['creator', 'project', 'status', 'priority'])->where('project_id', $project->id)->paginate(20);
        } else {
            $tickets = Ticket::with(['creator', 'project', 'status', 'priority'])->paginate(20);
        }

        return TicketIndexResource::collection($tickets);
    }

    public function create(TicketRequest $request): void
    {
        $data = [
            'project_id'    => $request->project_id,
            'created_by'    => Auth::user()->id,
            'subject'       => $request->subject,
            'description'   => $request->description,
            'url'           => $request->url,
            'status_id'     => $request->status_id,
            'priority_id'   => $request->priority_id,
        ];

        Ticket::create($data);
    }

    public function update(TicketRequest $request, Ticket $ticket): void
    {
        $ticket->project_id     = $request->project_id;
        $ticket->subject        = $request->subject;
        $ticket->description    = $request->description;
        $ticket->url            = $request->url;
        $ticket->status_id      = $request->status_id;
        $ticket->priority_id    = $request->priority_id;

        $ticket->save();
    }

    public function get(Ticket $ticket): TicketShowResource
    {
        $ticket->load(['creator', 'project', 'status', 'priority', 'attachments', 'comments']);

        return new TicketShowResource($ticket);
    }

    public function delete(Ticket $ticket): void
    {
        $ticket->delete();
    }
}
