<?php

namespace App\Http\Resources\Milestone;

use App\Http\Resources\PriorityResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MilestoneTaskResource extends JsonResource
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
            'tags'          => $this->tags,
            'status'        => new StatusResource($this->status),
            'priority'      => new PriorityResource($this->priority),
            'adder'         => new UserResource($this->pivot->adder),
            'updater'       => new UserResource($this->pivot->updater),
        ];
    }
}
