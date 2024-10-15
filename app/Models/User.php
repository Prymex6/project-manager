<?php

namespace App\Models;

use App\Models\Chat\ChatMessage;
use App\Models\Task\TaskStatusHistory;
use App\Models\User\UserPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'login',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user')
            ->withPivot('created_at');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_group')
            ->withPivot('created_at');
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'file_user')
            ->withPivot('created_at');
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_user')
            ->withPivot('created_at');
    }

    public function discussions()
    {
        return $this->belongsToMany(Discussion::class, 'discussion_user')
            ->withPivot('created_at');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user')
            ->withPivot('created_at');
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_user')
            ->withPivot('permission', 'created_at');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'created_by');
    }

    public function statuses_history()
    {
        return $this->hasMany(TaskStatusHistory::class);
    }

    public function messages()
    {
        return $this->hasMany(TaskStatusHistory::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function uploadFile()
    {
        return $this->hasMany(File::class, 'uploaded_by');
    }

    public function createdMilestones()
    {
        return $this->hasMany(Milestone::class, 'created_by');
    }

    public function createdNotes()
    {
        return $this->hasMany(Note::class, 'created_by');
    }

    public function createdCheckLists()
    {
        return $this->hasMany(CheckList::class, 'created_by');
    }

    public function asignedCheckLists()
    {
        return $this->hasMany(CheckList::class, 'assigned');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function createdSchedules()
    {
        return $this->hasMany(Schedule::class, 'created_by');
    }

    public function createdTickets()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function userMessage()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function permission()
    {
        return $this->belongsTo(UserPermission::class);
    }
}
