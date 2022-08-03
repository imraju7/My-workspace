<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $table = 'vacancies';

    protected $fillable = [
        'customer_id', 'title', 'description', 'is_vacant', 'job_type', 'expires_on', 'views'
    ];

    public function company()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
