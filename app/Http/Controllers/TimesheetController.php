<?php

namespace App\Http\Controllers;

use App\Http\Requests\Timesheet\TimesheetRequest;
use App\Models\Project;
use App\Models\Timesheet;
use App\Services\TimesheetService;

class TimesheetController extends Controller
{
    private TimesheetService $timesheetService;

    public function __construct(TimesheetService $service)
    {
        $this->timesheetService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project = null)
    {
        $timesheets = $this->timesheetService->all($project);

        return response()->json($timesheets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimesheetRequest $request)
    {
        $this->timesheetService->create($request);

        return response()->json('The timesheet has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Timesheet $timesheet)
    {
        $timesheet = $this->timesheetService->get($timesheet);

        return response()->json($timesheet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimesheetRequest $request, Timesheet $timesheet)
    {
        $this->timesheetService->update($request, $timesheet);

        return response()->json('The timesheet has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timesheet $timesheet)
    {
        $this->timesheetService->delete($timesheet);

        return response()->json('The timesheet has been deleted!', 200);
    }
}
