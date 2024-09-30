<?php

namespace App\Models\Project;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    use HasFactory;

    protected $table = 'project_statuses';

    protected $fillable = ['name', 'color'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
