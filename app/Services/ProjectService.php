<?php

namespace App\Services;

use App\Http\Requests\Project\ProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectService
{
    public function all(): AnonymousResourceCollection
    {
        $projects = Project::with(['company', 'status'])->paginate(20);

        return ProjectResource::collection($projects);
    }

    public function create(ProjectRequest $request): void
    {
        $data = [
            'name'          => $request->name,
            'company_id'    => $request->company_id,
            'description'   => $request->description,
            'tags'          => $request->tags,
            'status_id'     => $request->status_id,
            'started_at'    => $request->started_at ?? now(),
            'deadline_at'   => $request->deadline_at
        ];

        Project::create($data);
    }

    public function update(ProjectRequest $request, Project $project): void
    {
        $project->name          = $request->name;
        $project->company_id    = $request->company_id;
        $project->description   = $request->description;
        $project->tags          = $request->tags;
        $project->status_id     = $request->status_id;
        $project->started_at    = $request->started_at;
        $project->deadline_at   = $request->deadline_at;

        $project->save();
    }

    public function get(Project $project): ProjectResource
    {
        $project->load(['company', 'status']);

        return new ProjectResource($project);
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
