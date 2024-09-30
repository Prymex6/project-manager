<?php

namespace App\Models\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'task_status_history';

    protected $fillable = ['task_id', 'status_id', 'user_id'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
