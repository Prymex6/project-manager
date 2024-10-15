<?php

namespace App\Services;

use App\Http\Requests\Note\NoteRequest;
use App\Http\Resources\Note\NoteResource;
use App\Models\Note;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class NoteService
{
    public function all(?Project $project = null): AnonymousResourceCollection
    {
        if ($project) {
            $notes = Note::with(['creator', 'project'])->where('project_id', $project->id)->paginate(20);
        } else {
            $notes = Note::with(['creator', 'project'])->paginate(20);
        }

        return NoteResource::collection($notes);
    }

    public function create(NoteRequest $request): void
    {
        $data = [
            'project_id'    => $request->project_id,
            'created_by'    => Auth::user()->id,
            'content'       => $request->content,
        ];

        Note::create($data);
    }

    public function update(NoteRequest $request, Note $note): void
    {
        $note->project_id   = $request->project_id;
        $note->content      = $request->content;

        $note->save();
    }

    public function get(Note $note): NoteResource
    {
        $note->load(['creator', 'project']);

        return new NoteResource($note);
    }

    public function delete(Note $note): void
    {
        $note->delete();
    }
}
