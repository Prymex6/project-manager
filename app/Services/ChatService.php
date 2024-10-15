<?php

namespace App\Services;

use App\Http\Requests\Chat\ChatRequest;
use App\Http\Resources\Chat\ChatIndexResource;
use App\Http\Resources\Chat\ChatShowResource;
use App\Models\Chat;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChatService
{
    public function all(): AnonymousResourceCollection
    {
        $chats = Chat::paginate(20);

        return ChatIndexResource::collection($chats);
    }

    public function create(ChatRequest $request): void
    {
        $data = [
            'title'         => $request->title,
            'description'   => $request->description,
            'tags'          => $request->tags,
        ];

        Chat::create($data);
    }

    public function update(ChatRequest $request, Chat $chat): void
    {
        $chat->title        = $request->title;
        $chat->description  = $request->description;
        $chat->tags         = $request->tags;

        $chat->save();
    }

    public function get(Chat $chat): ChatShowResource
    {
        $chat->load(['messages']);

        return new ChatShowResource($chat);
    }

    public function delete(Chat $chat): void
    {
        $chat->delete();
    }
}
