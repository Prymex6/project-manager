<?php

namespace App\Http\Controllers;

use App\Http\Requests\Activity\ActivityRequest;
use App\Models\Activity;
use App\Models\Project;
use App\Services\ActivityService;

class ActivityController extends Controller
{
    private ActivityService $activityService;

    public function __construct(ActivityService $service)
    {
        $this->activityService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project = null)
    {
        $activities = $this->activityService->all($project);

        return response()->json($activities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {
        $this->activityService->create($request);

        return response()->json('The activity has been created!', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $this->activityService->delete($activity);

        return response()->json('The activity has been deleted!', 200);
    }
}
