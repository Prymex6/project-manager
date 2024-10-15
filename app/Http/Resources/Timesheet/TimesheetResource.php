<?php

namespace App\Http\Resources\Timesheet;

use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Task\TaskIndexResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimesheetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'project'       => $this->project->name,
            'user'          => new UserResource($this->whenLoaded('user')),
            'task'          => new TaskIndexResource($this->whenLoaded('task')),
            'tags'          => $this->tags,
            'note'          => $this->note,
            'hours'         => $this->hours,
            'started_at'    => $this->started_at,
            'ended_at'      => $this->ended_at,
        ];
    }
}
