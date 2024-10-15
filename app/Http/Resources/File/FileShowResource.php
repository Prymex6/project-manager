<?php

namespace App\Http\Resources\File;

use App\Http\Resources\CommentResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'project'       => $this->project->name,
            'uploader'      => new UserResource($this->whenLoaded('uploader')),
            'name'          => $this->name,
            'type'          => $this->type,
            'subject'       => $this->subject,
            'description'   => $this->description,
            'download'      => $this->download,
            'comments'      => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
