<?php

namespace App\Models\Event;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStatus extends Model
{
    use HasFactory;

    protected $table = 'event_statuses';

    protected $fillable = ['name', 'color'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
