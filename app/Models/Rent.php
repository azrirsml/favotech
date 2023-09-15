<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Rent extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public static function rentLists()
    {
        $ownerCarIds = auth()->user()->cars()->pluck('id')->toArray();

        return auth()->user()->isOwner()
            ? Rent::whereIn('car_id', $ownerCarIds)->get()
            : Rent::where('tenant_id', auth()->id())->get();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('receipts')
            ->nonQueued();
    }
}
