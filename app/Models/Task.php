<?php

namespace App\Models;

use App\Models\Task\TaskPriority;
use App\Models\Task\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'name',
        'created_by',
        'description',
        'tags',
        'is_private',
        'status_id',
        'priority_id',
        'planned_hours',
        'started_at',
        'deadline_at',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user')
            ->withPivot('permission', 'created_at');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'task_group')
            ->withPivot('permission', 'created_at');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'task_comment')
            ->withPivot('created_at');
    }

    public function milestones()
    {
        return $this->belongsToMany(Milestone::class, 'task_milestone')
            ->withPivot(['added_by', 'updated_by'])
            ->withTimestamps();
    }

    public function priority()
    {
        return $this->belongsTo(TaskPriority::class);
    }

    public function statuses_history()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function checklists()
    {
        return $this->hasMany(CheckList::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
