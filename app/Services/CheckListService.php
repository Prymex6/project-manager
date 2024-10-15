<?php

namespace App\Services;

use App\Http\Requests\CheckList\CheckListRequest;
use App\Models\CheckList;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class CheckListService
{
    public function create(CheckListRequest $request, Task $task)
    {
        $data = [
            'task_id'       => $task->id,
            'created_by'    => Auth::user()->id,
            'content'       => $request->content,
            'assigned'      => $request->assigned
        ];

        CheckList::create($data);
    }

    public function update(CheckListRequest $request, CheckList $checkList): void
    {
        $checkList->content     =   $request->content;
        $checkList->assigned    =   $request->assigned;

        $checkList->save();
    }

    public function delete(CheckList $checkList): void
    {
        $checkList->delete();
    }
}
