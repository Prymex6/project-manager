<?php

namespace App\Http\Resources\Discussion;

use App\Http\Resources\CommentResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionShowResource extends JsonResource
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
            'subject'       => $this->subject,
            'description'   => $this->description,
            'comments'      => CommentResource::collection($this->whenLoaded('comments'))
        ];
    }
}
