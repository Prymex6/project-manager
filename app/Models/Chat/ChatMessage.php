<?php

namespace App\Models\Chat;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatMessage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'chat_message';

    protected $fillable = ['chat_id', 'user_id', 'content'];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
