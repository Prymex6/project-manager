<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\TicketRequest;
use App\Models\Project;
use App\Models\Ticket;
use App\Services\TicketService;

class TicketController extends Controller
{
    private TicketService $ticketService;

    public function __construct(TicketService $service)
    {
        $this->ticketService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project = null)
    {
        $tickets = $this->ticketService->all($project);

        return response()->json($tickets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $this->ticketService->create($request);

        return response()->json('The ticket has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket = $this->ticketService->get($ticket);

        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $this->ticketService->update($request, $ticket);

        return response()->json('The ticket has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $this->ticketService->delete($ticket);

        return response()->json('The ticket has been deleted!', 200);
    }
}
