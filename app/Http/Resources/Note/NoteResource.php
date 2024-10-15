<?php

namespace App\Http\Resources\Note;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'content'       => $this->content,
        ];
    }
}
