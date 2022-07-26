<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $fillable = [
        'user_id', 'address', 'is_recruited', 'recruited_by'
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function recruiter()
    {
        $this->belongsTo(Customer::class, 'id', 'recruited_by');
    }

    public function application()
    {
        $this->hasMany(Application::class, 'user_id', 'user_id');
    }
}
