<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'color',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_group')
            ->withPivot('permission', 'created_at');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_group')
            ->withPivot('created_at');
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'file_group')
            ->withPivot('permission', 'created_at');
    }

    public function discussions()
    {
        return $this->belongsToMany(Discussion::class, 'discussion_group')
            ->withPivot('permission', 'created_at');
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_group')
            ->withPivot('permission', 'created_at');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_group')
            ->withPivot('permission', 'created_at');
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_group')
            ->withPivot('permission', 'created_at');
    }
}
