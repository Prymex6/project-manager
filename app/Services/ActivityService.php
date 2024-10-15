<?php

namespace App\Services;

use App\Http\Requests\Activity\ActivityRequest;
use App\Http\Resources\Activity\ActivityResource;
use App\Models\Activity;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ActivityService
{
    public function all(?Project $project = null): AnonymousResourceCollection
    {
        if ($project) {
            $activities = Activity::with(['creator', 'project', 'task'])->where('project_id', $project->id)->paginate(20);
        } else {
            $activities = Activity::with(['creator', 'project', 'task'])->paginate(20);
        }

        return ActivityResource::collection($activities);
    }

    public function create(ActivityRequest $request): void
    {
        $data = [
            'project_id'    => $request->project_id,
            'task_id'       => $request->task_id,
            'created_by'    => Auth::user()->id,
            'type'          => $request->type,
            'content'       => $request->content,
        ];

        Activity::create($data);
    }

    public function delete(Activity $activity): void
    {
        $activity->delete();
    }
}
