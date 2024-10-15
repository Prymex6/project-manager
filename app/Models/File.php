<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'uploaded_by',
        'name',
        'type',
        'subject',
        'description',
        'download',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'file_user')
            ->withPivot('permission', 'created_at');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'file_group')
            ->withPivot('permission', 'created_at');
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'file_comment')
            ->withPivot('created_at');
    }
}
