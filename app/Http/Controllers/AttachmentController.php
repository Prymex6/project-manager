<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attachment\AttachmentRequest;
use App\Models\Attachment;
use App\Models\Ticket;
use App\Services\AttachmentService;

class AttachmentController extends Controller
{
    private AttachmentService $attachmentService;

    public function __construct(AttachmentService $service)
    {
        $this->attachmentService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Ticket $ticket = null)
    {
        $attachments = $this->attachmentService->all($ticket);

        return response()->json($attachments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttachmentRequest $request)
    {
        $this->attachmentService->create($request);

        return response()->json('The attachment has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attachment $attachment)
    {
        $attachment = $this->attachmentService->get($attachment);

        return response()->json($attachment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttachmentRequest $request, Attachment $attachment)
    {
        $this->attachmentService->update($request, $attachment);

        return response()->json('The attachment has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachment $attachment)
    {
        $this->attachmentService->delete($attachment);

        return response()->json('The attachment has been deleted!', 200);
    }
}
