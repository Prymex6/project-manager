<?php

namespace App\Models;

use App\Models\Chat\ChatMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

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

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'chat_group')
            ->withPivot('permission', 'created_at');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
