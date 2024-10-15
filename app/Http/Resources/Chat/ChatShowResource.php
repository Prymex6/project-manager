<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'         => $this->title,
            'description'   => $this->description,
            'tags'          => $this->tags,
            'messages'      => ChatMessagesResource::collection($this->whenLoaded('messages'))
        ];
    }
}
