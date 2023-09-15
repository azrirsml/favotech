<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Car extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $guarded = [];

    protected $dates = ['available_date'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('car_images')
            ->nonQueued();
    }
}
