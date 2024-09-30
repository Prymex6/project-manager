<?php

namespace App\Services;

use App\Http\Requests\Task\TaskRequest;
use App\Http\Resources\Task\TaskIndexResource;
use App\Http\Resources\Task\TaskShowResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function all(?Project $project = null): AnonymousResourceCollection
    {
        if ($project) {
            $tasks = Task::with(['priority', 'status', 'creator', 'project'])->where('project_id', $project->id)->paginate(20);
        } else {
            $tasks = Task::with(['priority', 'status', 'creator', 'project'])->paginate(20);
        }

        return TaskIndexResource::collection($tasks);
    }

    public function create(TaskRequest $request): void
    {
        $data = [
            'project_id'    => $request->project_id,
            'name'          => $request->name,
            'created_by'    => Auth::user()->id,
            'description'   => $request->description,
            'tags'          => $request->tags,
            'is_private'    => $request->is_private,
            'status_id'     => $request->status_id,
            'priority_id'   => $request->priority_id,
            'planned_hours' => $request->status_id,
            'started_at'    => $request->started_at ?? now(),
            'deadline_at'   => $request->deadline_at
        ];

        Task::create($data);
    }

    public function update(TaskRequest $request, Task $task): void
    {
        $task->project_id       = $request->project_id;
        $task->name             = $request->name;
        // $task->created_by       = $request->created_by;
        $task->description      = $request->description;
        $task->tags             = $request->tags;
        $task->is_private       = $request->is_private;
        $task->status_id        = $request->status_id;
        $task->priority_id      = $request->priority_id;
        $task->planned_hours    = $request->status_id;
        $task->started_at       = $request->started_at ?? now();
        $task->deadline_at      = $request->deadline_a;

        $task->save();
    }

    public function get(Task $task): TaskShowResource
    {
        $task->load(['priority', 'status', 'creator', 'comments', 'checklists', 'project']);

        return new TaskShowResource($task);
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}
