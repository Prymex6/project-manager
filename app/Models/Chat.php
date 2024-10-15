<?php

namespace App\Models;

use App\Models\Chat\ChatMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'tags',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_user')
            ->withPivot('permission', 'created_at');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
