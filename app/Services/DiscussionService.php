<?php

namespace App\Services;

use App\Http\Requests\Discussion\DiscussionRequest;
use App\Http\Resources\Discussion\DiscussionIndexResource;
use App\Http\Resources\Discussion\DiscussionShowResource;
use App\Models\Discussion;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class DiscussionService
{
    public function all(?Project $project = null): AnonymousResourceCollection
    {
        if ($project) {
            $discussions = Discussion::with(['creator', 'project'])->where('project_id', $project->id)->paginate(20);
        } else {
            $discussions = Discussion::with(['creator', 'project'])->paginate(20);
        }

        return DiscussionIndexResource::collection($discussions);
    }

    public function create(DiscussionRequest $request): void
    {
        $data = [
            'project_id'    => $request->project_id,
            'created_by'    => Auth::user()->id,
            'subject'       => $request->subject,
            'description'   => $request->description,
        ];

        Discussion::create($data);
    }

    public function update(DiscussionRequest $request, Discussion $discussion): void
    {
        $discussion->project_id       = $request->project_id;
        $discussion->subject          = $request->subject;
        $discussion->description      = $request->description;

        $discussion->save();
    }

    public function get(Discussion $discussion): DiscussionShowResource
    {
        $discussion->load(['creator', 'project', 'comments']);

        return new DiscussionShowResource($discussion);
    }

    public function delete(Discussion $discussion): void
    {
        $discussion->delete();
    }
}
