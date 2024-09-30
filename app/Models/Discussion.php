<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'created_by',
        'subject',
        'description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'discussion_user')
            ->withPivot('permission', 'created_at');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'discussion_group')
            ->withPivot('permission', 'created_at');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'discussion_comment')
            ->withPivot('created_at');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
