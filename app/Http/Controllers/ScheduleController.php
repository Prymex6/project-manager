<?php

namespace App\Http\Controllers;

use App\Http\Requests\Schedule\ScheduleRequest;
use App\Models\Schedule;
use App\Models\User;
use App\Services\ScheduleService;

class ScheduleController extends Controller
{
    private ScheduleService $scheduleService;

    public function __construct(ScheduleService $service)
    {
        $this->scheduleService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(User $user = null)
    {
        $schedules = $this->scheduleService->all($user);

        return response()->json($schedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleRequest $request)
    {
        $this->scheduleService->create($request);

        return response()->json('The schedule has been created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $schedule = $this->scheduleService->get($schedule);

        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $this->scheduleService->update($request, $schedule);

        return response()->json('The schedule has been updated!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $this->scheduleService->delete($schedule);

        return response()->json('The schedule has been deleted!', 200);
    }
}
