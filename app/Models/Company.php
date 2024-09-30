<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'telephone',
        'website'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
