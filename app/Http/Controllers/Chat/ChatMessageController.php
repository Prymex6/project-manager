<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ChatMessageRequest;
use App\Models\Chat;
use App\Models\Chat\ChatMessage;
use App\Services\Chat\ChatMessageService;

class ChatMessageController extends Controller
{
    private ChatMessageService $chatMessageService;

    public function __construct(ChatMessageService $service)
    {
        $this->chatMessageService = $service;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChatMessageRequest $request, Chat $chat)
    {
        $this->chatMessageService->create($request, $chat);

        return response()->json('The message has been created!', 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChatMessageRequest $request, ChatMessage $chatMessage)
    {
        $this->chatMessageService->update($request, $chatMessage);

        return response()->json('The message has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatMessage $chatMessage)
    {
        $this->chatMessageService->delete($chatMessage);

        return response()->json('The message has been deleted!', 200);
    }
}
