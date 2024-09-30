<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Models\Discussion;
use App\Models\File;
use App\Models\Task;
use App\Models\Ticket;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    private CommentService $commentService;

    public function __construct(CommentService $service)
    {
        $this->commentService = $service;
    }

    public function addCommentToDiscussion(CommentRequest $request, Discussion $discussion): JsonResponse
    {
        $this->commentService->createCommentToDiscussion($request, $discussion);

        return response()->json('The comment has been created!', 201);
    }

    public function addCommentToFile(CommentRequest $request, File $file): JsonResponse
    {
        $this->commentService->createCommentToFile($request, $file);

        return response()->json('The comment has been created!', 201);
    }

    public function addCommentToTask(CommentRequest $request, Task $task): JsonResponse
    {
        $this->commentService->createCommentToTask($request, $task);

        return response()->json('The comment has been created!', 201);
    }

    public function addCommentToTicket(CommentRequest $request, Ticket $ticket): JsonResponse
    {
        $this->commentService->createCommentToTicket($request, $ticket);

        return response()->json('The comment has been created!', 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $this->commentService->update($request, $comment);

        return response()->json('The comment has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->commentService->delete($comment);

        return response()->json('The comment has been deleted!', 200);
    }
}
