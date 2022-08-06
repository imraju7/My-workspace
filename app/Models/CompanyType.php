<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    use HasFactory;

    protected $table = 'company_types';

    protected $fillable = [
        'name'
    ];

    public function company()
    {
        return $this->hasMany(Customer::class, 'company_type_id', 'id');
    }

    public function hello()
    {
        if ($this->company()->exists()) {
            return 1;
        } else {
            return 0;
        }
    }
}
