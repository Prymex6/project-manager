<?php

namespace App\Models;

use App\Models\Task\TaskPriority;
use App\Models\Task\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'created_by',
        'subject',
        'description',
        'url',
        'priority_id',
        'status_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'ticket_user')
            ->withPivot('permission', 'created_at');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'ticket_group')
            ->withPivot('permission', 'created_at');
    }

    public function priority()
    {
        return $this->belongsTo(TaskPriority::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'ticket_comment')
            ->withPivot('created_at');
    }
}
