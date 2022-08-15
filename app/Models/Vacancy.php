<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $table = 'vacancies';

    protected $fillable = [
        'customer_id', 'title', 'description', 'address', 'is_vacant', 'job_type', 'expires_on', 'views', 'is_published'
    ];

    public function company()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function application()
    {
        return $this->hasOne(Application::class, 'vacancy_id', 'id');
    }

    public function hasApplied()
    {
        return $this->application()->where('user_id', auth()->user()->id);
    }
}
