<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyFeedback extends Model
{
    use HasFactory;
    protected $table = 'vacancy_feedback';
    protected $fillable = [
        'vacancy_id', 'user_id', 'message'
    ];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
