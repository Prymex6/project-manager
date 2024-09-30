<?php

namespace App\Models\Project;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSetting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'project_settings';

    protected $fillable = ['project_id', 'min_hours', 'max_hours', 'visible_tabs', 'hide_tasks_on_main_table', 'created_at'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
