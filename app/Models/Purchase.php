<?php

namespace App\Models;

use Fomvasss\MediaLibraryExtension\HasMedia\HasMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Fomvasss\MediaLibraryExtension\HasMedia\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Purchase extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\PurchasesFactory> */
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];

    protected $appends = ['amount'];

    protected $mediaSingleCollections = ['image'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn () => round($this->price * $this->quantity,2),
        );
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->format('webp')
            ->quality(93)
            ->fit(Fit::Contain, 100, 140);
    }
}
