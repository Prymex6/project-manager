<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\StatusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'company'       => new ProjectCompanyResource($this->whenLoaded('company')),
            'description'   => $this->description,
            'tags'          => $this->tags,
            'status'        => new StatusResource($this->whenLoaded('status')),
            'started_at'    => $this->started_at,
            'ended_at'      => $this->ended_at,
        ];
    }
}
