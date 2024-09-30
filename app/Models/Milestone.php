<?php

namespace App\Models;

use App\Models\Task\TaskMilestone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'created_by',
        'tags',
        'name',
        'description',
        'order',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_milestone')
            ->using(TaskMilestone::class)
            ->withPivot(['added_by', 'updated_by'])
            ->withTimestamps();
    }
}
