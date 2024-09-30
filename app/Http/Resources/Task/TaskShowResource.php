<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\CheckListResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PriorityResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskShowResource extends JsonResource
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
            'description'   => $this->description,
            'tags'          => $this->tags,
            'is_private'    => $this->is_private,
            'status'        => new StatusResource($this->whenLoaded('status')),
            'priority'      => new PriorityResource($this->whenLoaded('priority')),
            'comments'      => CommentResource::collection($this->whenLoaded('comments')),
            'checklists'    => CheckListResource::collection($this->whenLoaded('checklists')),
            'project'       => $this->project->name,
            'planned_hours' => $this->planned_hours,
            'started_at'    => $this->started_at,
            'ended_at'      => $this->ended_at,
        ];
    }
}
