<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'user_id', 'designation', 'company_type_id', 'company_name',
        'company_description', 'company_phone', 'company_email', 'company_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Customer::class, 'id', 'company_type_id');
    }
}
