<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class User extends Authenticatable implements FilamentUser, MustVerifyEmail, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;


    protected $fillable = ['name', 'email', 'password', 'role_id', 'is_banned'];

    protected $hidden = ['password', 'remember_token',];

    public function registerMediaCollections(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->width(50)
            ->height(50)
            ->nonQueued();
        $this
            ->addMediaCollection('avatar')
            ->useFallbackUrl(asset('dummy.png'))
            ->singleFile();
    }

    public function canAccessFilament(): bool
    {
        return $this->role->name == 'admin';
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
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
        return $this->hasMany(Application::class, 'user_id', 'id');
    }
}
