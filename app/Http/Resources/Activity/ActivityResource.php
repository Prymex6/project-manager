<?php

namespace App\Http\Resources\Activity;

use App\Http\Resources\Task\TaskIndexResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'task'          => new TaskIndexResource($this->whenLoaded('task')),
            'creator'       => new UserResource($this->whenLoaded('creator')),
            'type'          => $this->type,
            'content'       => $this->content,
        ];
    }
}
