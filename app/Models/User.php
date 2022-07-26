<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role_id', 'is_banned'];

    protected $hidden = ['password', 'remember_token',];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id', 'role_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id', 'id');
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'user_id', 'id');
    }

    public function application()
    {
        $this->hasMany(Application::class, 'user_id', 'id');
    }
}
