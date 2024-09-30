<?php

namespace App\Models;

use App\Models\Project\ProjectSetting;
use App\Models\Project\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'company_id',
        'description',
        'tags',
        'status_id',
        'started_at',
        'deadline_at',
    ];

    public function settings()
    {
        return $this->hasOne(ProjectSetting::class);
    }

    public function status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withPivot('permission', 'created_at');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'project_group')
            ->withPivot('permission', 'created_at');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
}
