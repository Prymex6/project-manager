<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\NoteRequest;
use App\Models\Note;
use App\Models\Project;
use App\Services\NoteService;

class NoteController extends Controller
{
    private NoteService $noteService;

    public function __construct(NoteService $service)
    {
        $this->noteService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project = null)
    {
        $notes = $this->noteService->all($project);

        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        $this->noteService->create($request);

        return response()->json('The note has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        $note = $this->noteService->get($note);

        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note)
    {
        $this->noteService->update($request, $note);

        return response()->json('The note has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $this->noteService->delete($note);

        return response()->json('The note has been deleted!', 200);
    }
}
