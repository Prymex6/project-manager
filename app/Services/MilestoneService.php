<?php

namespace App\Services;

use App\Http\Requests\Milestone\MilestoneRequest;
use App\Http\Resources\Milestone\MilestoneResource;
use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class MilestoneService
{
    public function all(?Project $project = null): AnonymousResourceCollection
    {
        if ($project) {
            $milestones = Milestone::with(['creator', 'project', 'tasks'])->where('project_id', $project->id)->paginate(20);
        } else {
            $milestones = Milestone::with(['creator', 'project', 'tasks'])->paginate(20);
        }

        return MilestoneResource::collection($milestones);
    }

    public function create(MilestoneRequest $request): void
    {
        $data = [
            'project_id'    => $request->project_id,
            'created_by'    => Auth::user()->id,
            'tags'          => $request->tags,
            'name'          => $request->name,
            'description'   => $request->description,
            'order'   => $request->order,
        ];

        Milestone::create($data);
    }

    public function update(MilestoneRequest $request, Milestone $milestone): void
    {
        $milestone->project_id      = $request->project_id;
        $milestone->tags            = $request->tags;
        $milestone->name            = $request->name;
        $milestone->description     = $request->description;
        $milestone->order           = $request->order;

        $milestone->save();
    }

    public function get(Milestone $milestone): MilestoneResource
    {
        $milestone->load(['creator', 'project', 'tasks']);

        return new MilestoneResource($milestone);
    }

    public function delete(Milestone $milestone): void
    {
        $milestone->delete();
    }
}
