<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'conversation_id', 'sender', 'receiver', 'message'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'id', 'conversation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'id', 'sender');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'id', 'receiver');
    }
}
