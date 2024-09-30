<?php

namespace App\Http\Resources\Milestone;

use App\Http\Resources\Milestone\MilestoneTaskResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MilestoneResource extends JsonResource
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
            'creator'       => new UserResource($this->whenLoaded('creator')),
            'name'          => $this->name,
            'description'   => $this->description,
            'order'         => $this->order,
            'tasks'         => MilestoneTaskResource::collection($this->whenLoaded('tasks')),
        ];
    }
}
