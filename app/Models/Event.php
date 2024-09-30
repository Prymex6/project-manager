<?php

namespace App\Models;

use App\Models\Event\EventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'created_by',
        'title',
        'description',
        'tags',
        'status_id',
        'started_at',
        'ended_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function status()
    {
        return $this->hasOne(EventStatus::class);
    }
}
