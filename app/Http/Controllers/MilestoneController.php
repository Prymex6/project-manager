<?php

namespace App\Http\Controllers;

use App\Http\Requests\Milestone\MilestoneRequest;
use App\Models\Milestone;
use App\Models\Project;
use App\Services\MilestoneService;

class MilestoneController extends Controller
{
    private MilestoneService $milestoneService;

    public function __construct(MilestoneService $service)
    {
        $this->milestoneService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project = null)
    {
        $milestones = $this->milestoneService->all($project);

        return response()->json($milestones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MilestoneRequest $request)
    {
        $this->milestoneService->create($request);

        return response()->json('The milestone has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Milestone $milestone)
    {
        $milestone = $this->milestoneService->get($milestone);

        return response()->json($milestone);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MilestoneRequest $request, Milestone $milestone)
    {
        $this->milestoneService->update($request, $milestone);

        return response()->json('The milestone has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Milestone $milestone)
    {
        $this->milestoneService->delete($milestone);

        return response()->json('The milestone has been deleted!', 200);
    }
}
