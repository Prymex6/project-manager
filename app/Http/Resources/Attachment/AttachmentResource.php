<?php

namespace App\Http\Resources\Attachment;

use App\Http\Resources\Ticket\TicketIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ticket'    => new TicketIndexResource($this->whenLoaded('ticket')),
            'path'      => $this->path
        ];
    }
}
