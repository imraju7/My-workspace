<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Setting extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'settings';
    protected $fillable = [
        'business_name', 'location', 'email', 'phone', 'address', 'footer_text', 'about_text'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('favicon')
            ->width(16)
            ->height(16)
            ->nonQueued();

        $this
            ->addMediaConversion('logosize')
            ->width(60)
            ->height(50)
            ->nonQueued();
    }
}
