<?php

namespace App\Services\Chat;

use App\Http\Requests\Chat\ChatMessageRequest;
use App\Models\Chat;
use App\Models\Chat\ChatMessage;
use Illuminate\Support\Facades\Auth;

class ChatMessageService
{

    public function create(ChatMessageRequest $request, Chat $chat): void
    {
        $data = [
            'chat_id'       => $chat->id,
            'user_id'       => Auth::user()->id,
            'content'       => $request->content,
        ];

        ChatMessage::create($data);
    }

    public function update(ChatMessageRequest $request, ChatMessage $chatMessage): void
    {
        $chatMessage->content   = $request->content;

        $chatMessage->save();
    }

    public function delete(ChatMessage $chatMessage): void
    {
        $chatMessage->delete();
    }
}
