<?php

namespace App\Models\Task;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskMilestone extends Pivot
{
    protected $table = 'task_milestone';

    public function adder()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
