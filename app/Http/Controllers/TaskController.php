<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $service)
    {
        $this->taskService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project = null)
    {
        $tasks = $this->taskService->all($project);

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $this->taskService->create($request);

        return response()->json('The task has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task = $this->taskService->get($task);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->taskService->update($request, $task);

        return response()->json('The task has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->taskService->delete($task);

        return response()->json('The task has been deleted!', 200);
    }
}
