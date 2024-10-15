<?php

namespace App\Services;

use App\Http\Requests\Timesheet\TimesheetRequest;
use App\Http\Resources\Timesheet\TimesheetResource;
use App\Models\Project;
use App\Models\Timesheet;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TimesheetService
{
    public function all(?Project $project = null): AnonymousResourceCollection
    {
        if ($project) {
            $timesheets = Timesheet::with(['user', 'project', 'task'])->where('project_id', $project->id)->paginate(20);
        } else {
            $timesheets = Timesheet::with(['user', 'project', 'task'])->paginate(20);
        }

        return TimesheetResource::collection($timesheets);
    }

    public function create(TimesheetRequest $request): void
    {
        $data = [
            'project_id'    => $request->project_id,
            'user_id'       => Auth::user()->id,
            'task_id'       => $request->task_id,
            'tags'          => $request->tags,
            'note'          => $request->note,
            'hours'         => $request->hours ?? 0,
            'started_at'    => $this->started_at ?? now(),
            'ended_at'      => $this->ended_at ?? null,
        ];

        Timesheet::create($data);
    }

    public function update(TimesheetRequest $request, Timesheet $timesheet): void
    {
        $timesheet->project_id  = $request->project_id;
        $timesheet->task_id     = $request->task_id;
        $timesheet->tags        = $request->tags;
        $timesheet->note        = $request->note;
        $timesheet->hours       = $request->hours ?? 0;
        $timesheet->started_at  = $this->started_at ?? now();
        $timesheet->ended_at    = $this->ended_at ?? null;

        $timesheet->save();
    }

    public function get(Timesheet $timesheet): TimesheetResource
    {
        $timesheet->load(['user', 'project', 'task']);

        return new TimesheetResource($timesheet);
    }

    public function delete(Timesheet $timesheet): void
    {
        $timesheet->delete();
    }
}
