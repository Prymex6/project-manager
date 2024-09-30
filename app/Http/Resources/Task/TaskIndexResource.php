<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\PriorityResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskIndexResource extends JsonResource
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
            'name'          => $this->name,
            'creator'       => new UserResource($this->whenLoaded('creator')),
            'project'       => $this->project->name,
            'description'   => $this->description,
            'tags'          => $this->tags,
            'is_private'    => $this->is_private,
            'status'        => new StatusResource($this->whenLoaded('status')),
            'priority'      => new PriorityResource($this->whenLoaded('priority')),
            'planned_hours' => $this->planned_hours,
            'started_at'    => $this->started_at,
            'ended_at'      => $this->ended_at,
        ];
    }
}
