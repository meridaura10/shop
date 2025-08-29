<?php

namespace App\Models;

use App\Models\Traits\Boot\HasSlug;
use App\Models\Traits\HasStaticLists;
use Fomvasss\Seo\Models\HasSeo;
use Fomvasss\SimpleTaxonomy\Models\Traits\HasTaxonomies;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Fomvasss\MediaLibraryExtension\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Fomvasss\MediaLibraryExtension\HasMedia\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, HasStaticLists, InteractsWithMedia, HasSlug, HasTaxonomies, HasSeo;

    const STATUS_PUBLISHED = 'published';

    const STATUS_UNPUBLISHED = 'unpublished';

    protected $guarded = ['id'];

    protected $attributes = [
        'status' => self::STATUS_UNPUBLISHED,
    ];

    protected $mediaMultipleCollections = ['images'];

    public function registerSeoDefaultTags(): array
    {
        return [
            'title' => $this->name,
            'description' => $this->description,
            'og_image' => $this->getFirstMediaUrl('images', 'thumb'),
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->term('brand_id')->whereVocabulary(Term::VOCABULARY_BRANDS);
    }

    public function category(): BelongsTo
    {
        return $this->term('category_id')->whereVocabulary(Term::VOCABULARY_PRODUCT_CATEGORIES);
    }

    public function categories(): BelongsToMany
    {
        return $this->terms()->whereVocabulary(Term::VOCABULARY_PRODUCT_CATEGORIES);
    }

    public function characteristics(): BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'model');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        $query
            ->when($search, fn($q, $v) => $q->where('name', 'like', "%{$v}%"));

        return $query;
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query
            ->when($filters['name'] ?? null, fn($q, $v) => $q->where('name', 'like', "%{$v}%"))
            ->when($filters['price_from'] ?? null, fn($q, $v) => $q->where('price', '>=', $v))
            ->when($filters['price_to'] ?? null, fn($q, $v) => $q->where('price', '<=', $v))
            ->when($filters['category_id'] ?? null, fn($q, $v) => $q->where('category_id', $v))
            ->when($filters['brand_id'] ?? null, fn($q, $v) => $q->where('brand_id', $v))
            ->when($filters['characteristics'] ?? null, fn($q, $v) => $q->whereHas('characteristics', function ($cg) use ($v) {
                $cg->whereIn('characteristics.id',$v);
            }))
            ->when(isset($filters['has_photo']), function ($q) use ($filters) {
                if ($filters['has_photo'] == 2) {
                    $q->has('media');
                } elseif ($filters['has_photo'] == 1) {
                    $q->doesntHave('media');
                }
            });

            if($filters['sort'] ?? null){
                $query->orderBy($filters['sort'] ?? null, $filters['order'] ?? 'asc');
            }

        return $query;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public static function statusesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::STATUS_PUBLISHED,
                'name' => trans('lists.products_statuses.' . self::STATUS_PUBLISHED . '.name'),
            ],
            [
                'key' => self::STATUS_UNPUBLISHED,
                'name' => trans('lists.products_statuses.' . self::STATUS_UNPUBLISHED . '.name'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }

    public function customMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('main')
            ->singleFile();

        $this->addMediaConversion('preview')
            ->format('webp')->quality(93)
            ->fit(Fit::Contain, 400, 350);
    }
}
