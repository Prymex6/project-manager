<?php

namespace App\Models\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $table = 'task_statuses';

    protected $fillable = ['name', 'color'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function statuses_history()
    {
        return $this->belongsTo(TaskStatusHistory::class);
    }
}
