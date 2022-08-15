<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $fillable = [
        'user_id', 'address', 'skills', 'educational_qualifications', 'is_recruited', 'recruited_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function recruiter()
    {
        return $this->belongsTo(Customer::class, 'recruited_by', 'id');
    }

    public function application()
    {
        return $this->hasMany(Application::class, 'user_id', 'user_id');
    }
}
