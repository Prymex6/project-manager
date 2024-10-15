<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chat\ChatRequest;
use App\Models\Chat;
use App\Services\ChatService;

class ChatController extends Controller
{
    private ChatService $chatService;

    public function __construct(ChatService $service)
    {
        $this->chatService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chats = $this->chatService->all();

        return response()->json($chats);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChatRequest $request)
    {
        $this->chatService->create($request);

        return response()->json('The chat has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        $chat = $this->chatService->get($chat);

        return response()->json($chat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChatRequest $request, Chat $chat)
    {
        $this->chatService->update($request, $chat);

        return response()->json('The chat has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        $this->chatService->delete($chat);

        return response()->json('The chat has been deleted!', 200);
    }
}
