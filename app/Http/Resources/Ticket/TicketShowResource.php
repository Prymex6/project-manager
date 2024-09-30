<?php

namespace App\Http\Resources\Ticket;

use App\Http\Resources\AttachmentResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PriorityResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketShowResource extends JsonResource
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
            'url'           => $this->url,
            'status'        => new StatusResource($this->whenLoaded('status')),
            'priority'      => new PriorityResource($this->whenLoaded('priority')),
            'comments'      => CommentResource::collection($this->whenLoaded('comments')),
            'attachments'   => AttachmentResource::collection($this->whenLoaded('attachments'))
        ];
    }
}
