<?php

namespace App\Models;


use App\Models\Traits\Boot\HasSlug;
use App\Models\Traits\HasStaticLists;
use Fomvasss\Seo\Models\HasSeo;
use Illuminate\Database\Eloquent\Builder;
use Fomvasss\MediaLibraryExtension\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Fomvasss\MediaLibraryExtension\HasMedia\InteractsWithMedia;

class Term extends \Fomvasss\SimpleTaxonomy\Models\Term implements HasMedia
{
    use HasStaticLists, InteractsWithMedia, HasSlug, HasSeo;

    const VOCABULARY_PRODUCT_CATEGORIES = 'product_categories';

    const VOCABULARY_ARTICLE_CATEGORIES = 'article_categories';

    const VOCABULARY_BRANDS = 'brands';

    const STATUS_PUBLISHED = 'published';

    const STATUS_UNPUBLISHED = 'unpublished';

    protected $mediaSingleCollections = ['image'];

    protected $attributes = [
        'weight' => 10000,
        'status' => Term::STATUS_UNPUBLISHED,
    ];

    public function brandProducts()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function registerSeoDefaultTags(): array
    {
        return [
            'title' => $this->name,
            'description' => $this->description,
            'og_image' => $this->getFirstMediaUrl('images', 'thumb'),
        ];
    }


    public static function vocabulariesList(string $columnKey = null, string $indexKey = null): array
    {
        $records = [
            [
                'slug' => 'product-categories',
                'key' => Term::VOCABULARY_PRODUCT_CATEGORIES,
                'name' => 'Product Categories',
                'has_nested' => true,
            ],
            [
                'slug' => 'article-categories',
                'key' => Term::VOCABULARY_ARTICLE_CATEGORIES,
                'name' => 'Article Categories',
                'has_nested' => false,
            ],
            [
                'slug' => 'brands',
                'key' => Term::VOCABULARY_BRANDS,
                'name' => 'Brands',
                'has_nested' => false,
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey);
    }

    public static function statusesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::STATUS_PUBLISHED,
                'name' => trans('lists.terms_statuses.' . self::STATUS_PUBLISHED . '.name'),
            ],
            [
                'key' => self::STATUS_UNPUBLISHED,
                'name' => trans('lists.terms_statuses.' . self::STATUS_UNPUBLISHED . '.name'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }

    public function customMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('main')
            ->singleFile();

        $this->addMediaConversion('table')
            ->format('webp')->quality(93)
            ->fit(Fit::Contain, 360, 257);
    }

    public static function whereVocabulary(array|string $vocabulary = null): Builder
    {
        $vocabularies = is_string($vocabulary) ? [$vocabulary] : $vocabulary;

        return static::query()->whereIn('vocabulary', $vocabularies);
    }

    public static function whereProductCategories(): Builder
    {
        return static::whereVocabulary(Term::VOCABULARY_PRODUCT_CATEGORIES);
    }

    public static function whereArticleCategories(): Builder
    {
        return static::whereVocabulary(Term::VOCABULARY_ARTICLE_CATEGORIES);
    }

    public static function whereBrands(): Builder
    {
        return static::whereVocabulary(Term::VOCABULARY_BRANDS);
    }

    public static function whereCategories(): Builder
    {
        return static::whereVocabulary([Term::VOCABULARY_ARTICLE_CATEGORIES, Term::VOCABULARY_ARTICLE_CATEGORIES]);
    }
}
