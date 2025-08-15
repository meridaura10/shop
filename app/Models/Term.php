<?php

namespace App\Models;


use App\Models\Traits\Boot\HasSlug;
use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Builder;
use Fomvasss\MediaLibraryExtension\HasMedia\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Fomvasss\MediaLibraryExtension\HasMedia\InteractsWithMedia;

class Term extends \Fomvasss\SimpleTaxonomy\Models\Term implements HasMedia
{
    use HasStaticLists, InteractsWithMedia, HasSlug;

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

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED);
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
            ->format('jpg')->quality(93)
            ->fit('crop', 360, 257);
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
