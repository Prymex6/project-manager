<?php

namespace App\Services;

use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Models\Discussion;
use App\Models\File;
use App\Models\Task;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function create(CommentRequest $request)
    {
        $data = [
            'created_by'    => Auth::user()->id,
            'content'       => $request->content,
        ];

        return Comment::create($data);
    }

    public function createCommentToDiscussion(CommentRequest $request, Discussion $discussion)
    {
        $comment = $this->create($request);

        $comment->tasks()->attach($discussion);
    }

    public function createCommentToFile(CommentRequest $request, File $file)
    {
        $comment = $this->create($request);

        $comment->tasks()->attach($file);
    }

    public function createCommentToTask(CommentRequest $request, Task $task)
    {
        $comment = $this->create($request);

        $comment->tasks()->attach($task);
    }

    public function createCommentToTicket(CommentRequest $request, Ticket $ticket)
    {
        $comment = $this->create($request);

        $comment->tasks()->attach($ticket);
    }

    public function update(CommentRequest $request, Comment $comment): void
    {
        $comment->content   =   $request->content;

        $comment->save();
    }

    public function delete(Comment $comment): void
    {
        $comment->delete();
    }
}
