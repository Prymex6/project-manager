<?php

namespace App\Models\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskPriority extends Model
{
    use HasFactory;

    protected $table = 'task_priorities';

    protected $fillable = ['name', 'color'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
