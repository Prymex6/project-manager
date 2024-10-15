<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\ChatMessageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AppMiddleware;
use App\Http\Middleware\ProjectMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', AppMiddleware::class])->group(function () {
    Route::resource('project', ProjectController::class);
    Route::resource('task', TaskController::class);
    Route::resource('discussion', DiscussionController::class);
    Route::resource('milestone', MilestoneController::class);
    Route::resource('ticket', TicketController::class);
    Route::resource('chat', ChatController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('event', EventController::class);
    Route::resource('file', FileController::class);
    Route::resource('note', NoteController::class);
    Route::resource('sale', SaleController::class);
    Route::resource('schedule', ScheduleController::class);
    Route::resource('group', GroupController::class);
    Route::resource('timesheet', TimesheetController::class);
    Route::resource('attachment', AttachmentController::class);
    Route::resource('user', UserController::class);

    Route::post('task/{task}/comment', [CommentController::class, 'addCommentToTask']);
    Route::put('comment/{comment}', [CommentController::class, 'update']);
    Route::delete('comment/{comment}', [CommentController::class, 'destroy']);

    Route::post('task/{task}/checklist', [CheckListController::class, 'store']);
    Route::put('checklist/{checkList}', [CheckListController::class, 'update']);
    Route::delete('checklist/{checkList}', [CheckListController::class, 'destroy']);

    Route::post('chat/{chat}/message', [ChatMessageController::class, 'store']);
    Route::put('message/{chatMessage}', [ChatMessageController::class, 'update']);
    Route::delete('message/{chatMessage}', [ChatMessageController::class, 'destroy']);

    Route::post('activity', [ActivityController::class, 'store']);
    Route::delete('activity/{activity}', [ActivityController::class, 'destroy']);

    Route::prefix('user/{user}/')->group(function () {
        Route::get('schedules', [TaskController::class, 'index']);
    });

    Route::prefix('ticket/{ticket}/')->group(function () {
        Route::get('attachments', [AttachmentController::class, 'index']);
    });

    Route::prefix('project/{project}/')->group(function () {
        Route::get('tasks', [TaskController::class, 'index']);
        Route::get('discussions', [DiscussionController::class, 'index']);
        Route::get('milestones', [MilestoneController::class, 'index']);
        Route::get('tickets', [TicketController::class, 'index']);
        Route::get('activities', [ActivityController::class, 'index']);
        Route::get('files', [FileController::class, 'index']);
        Route::get('notes', [NoteController::class, 'index']);
        Route::get('sales', [SaleController::class, 'index']);
    });

    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
