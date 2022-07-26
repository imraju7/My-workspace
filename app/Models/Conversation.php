<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversations';

    protected $fillable = [
        'topic', 'intitated_by', 'initiated_towards'
    ];

    public function initiator()
    {
        return $this->belongsTo(User::class, 'id', 'initiated_by');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'id', 'initiated_towards');
    }
}
