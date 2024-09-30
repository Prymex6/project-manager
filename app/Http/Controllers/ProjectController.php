<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    private ProjectService $projectService;

    public function __construct(ProjectService $service)
    {
        $this->projectService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->projectService->all();

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        $this->projectService->create($request);

        return response()->json('The project has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project = $this->projectService->get($project);

        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $this->projectService->update($request, $project);

        return response()->json('The project has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->projectService->delete($project);

        return response()->json('The project has been deleted!', 200);
    }
}
