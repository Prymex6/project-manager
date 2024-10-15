<?php

namespace App\Services;

use App\Http\Requests\Schedule\ScheduleRequest;
use App\Http\Resources\Schedule\ScheduleIndexResource;
use App\Http\Resources\Schedule\ScheduleResource;
use App\Http\Resources\Schedule\ScheduleShowResource;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ScheduleService
{
    public function all(?User $user = null): AnonymousResourceCollection
    {
        if ($user) {
            $schedules = Schedule::with(['user'])->where('project_id', $user->id)->paginate(20);
        } else {
            $schedules = Schedule::with(['user'])->paginate(20);
        }

        return ScheduleIndexResource::collection($schedules);
    }

    public function create(ScheduleRequest $request): void
    {
        $data = [
            'user_id'       => $request->user_id,
            'created_by'    => Auth::user()->id,
            'title'         => $request->title,
            'hours'         => $request->hours,
            'started_at'    => $request->started_at ?? now(),
            'ended_at'      => $request->ended_at ?? now(),
        ];

        Schedule::create($data);
    }

    public function update(ScheduleRequest $request, Schedule $schedule): void
    {
        $schedule->user_id      = $request->user_id;
        $schedule->title        = $request->title;
        $schedule->hours        = $request->hours;
        $schedule->started_at   = $request->started_at ?? now();
        $schedule->ended_at     = $request->ended_at ?? now();

        $schedule->save();
    }

    public function get(Schedule $schedule): ScheduleShowResource
    {
        $schedule->load(['user', 'creator']);

        return new ScheduleShowResource($schedule);
    }

    public function delete(Schedule $schedule): void
    {
        $schedule->delete();
    }
}
