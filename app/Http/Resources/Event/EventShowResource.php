<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\StatusResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user'          => new UserResource($this->whenLoaded('user')),
            'creator'       => new UserResource($this->whenLoaded('creator')),
            'title'         => $this->title,
            'description'   => $this->description,
            'tags'          => $this->tags,
            'status'        => new StatusResource($this->status),
            'started_at'    => $this->started_at,
            'ended_at'      => $this->ended_at,
        ];
    }
}
