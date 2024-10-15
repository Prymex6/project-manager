<?php

namespace App\Services;

use App\Http\Requests\Attachment\AttachmentRequest;
use App\Http\Resources\Attachment\AttachmentResource;
use App\Models\Attachment;
use App\Models\Ticket;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttachmentService
{
    public function all(?Ticket $ticket = null): AnonymousResourceCollection
    {
        if ($ticket) {
            $attachments = Attachment::with(['ticket'])->where('ticket_id', $ticket->id)->paginate(20);
        } else {
            $attachments = Attachment::with(['ticket'])->paginate(20);
        }

        return AttachmentResource::collection($attachments);
    }

    public function create(AttachmentRequest $request): void
    {
        $data = [
            'ticket_id' => $request->ticket_id,
            'path'      => $request->path,
        ];

        Attachment::create($data);
    }

    public function update(AttachmentRequest $request, Attachment $attachment): void
    {
        $attachment->ticket_id  = $request->ticket_id;
        $attachment->path       = $request->path;

        $attachment->save();
    }

    public function get(Attachment $attachment): AttachmentResource
    {
        $attachment->load(['ticket']);

        return new AttachmentResource($attachment);
    }

    public function delete(Attachment $attachment): void
    {
        $attachment->delete();
    }
}
