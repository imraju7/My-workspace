<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'user_id', 'vacancy_id', 'file'
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function candidate()
    {
        $this->belongsTo(Candidate::class, 'id', 'user_id');
    }

    public function vacancy()
    {
        $this->belongsTo(Vacancy::class, 'id', 'vacancy_id');
    }
}
