<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'task_id',
        'created_by',
        'content',
        'assigned'
    ];

    public function discussions()
    {
        return $this->belongsToMany(Discussion::class, 'discussion_comment')
            ->withPivot('created_at');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'file_comment')
            ->withPivot('created_at');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_comment')
            ->withPivot('created_at');
    }

    public function tickets()
    {
        return $this->belongsToMany(Task::class, 'task_comment')
            ->withPivot('created_at');
    }
}
