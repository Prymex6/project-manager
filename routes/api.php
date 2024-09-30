<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('project', ProjectController::class);
    Route::resource('task', TaskController::class);
    Route::resource('discussion', DiscussionController::class);
    Route::resource('milestone', MilestoneController::class);
    Route::resource('ticket', TicketController::class);

    Route::put('comment/{comment}', [CommentController::class, 'update']);
    Route::delete('comment/{comment}', [CommentController::class, 'destroy']);

    Route::post('task/{task}/comment', [CommentController::class, 'addCommentToTask']);
    
    Route::prefix('project/{project}/')->group(function () {
        Route::get('tasks', [TaskController::class, 'index']);
        Route::get('discussions', [DiscussionController::class, 'index']);
        Route::get('milestones', [MilestoneController::class, 'index']);
        Route::get('tickets', [TicketController::class, 'index']);
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
