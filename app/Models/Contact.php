<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $fillable = [
        'name', 'email', 'subject', 'message', 'contacted'
    ];

    protected $appends = ['created_at'];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->diffForHumans(),
        );
    }
}
