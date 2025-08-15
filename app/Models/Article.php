<?php

namespace App\Models;

use App\Models\Traits\Boot\HasSlug;
use App\Models\Traits\HasStaticLists;
use Fomvasss\SimpleTaxonomy\Models\Traits\HasTaxonomies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Fomvasss\MediaLibraryExtension\HasMedia\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Fomvasss\MediaLibraryExtension\HasMedia\InteractsWithMedia;
class Article extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory, HasStaticLists, InteractsWithMedia, HasSlug, HasTaxonomies;

    const TYPE_NEWS = 'news';

    const STATUS_PUBLISHED = 'published';

    const STATUS_UNPUBLISHED = 'unpublished';

    protected $guarded = ['id'];

    protected $attributes = [
        'status' => self::STATUS_UNPUBLISHED,
    ];

    protected $mediaMultipleCollections = ['images'];

    public function category(): BelongsTo
    {
        return $this->term('category_id')->whereVocabulary(Term::VOCABULARY_ARTICLE_CATEGORIES);
    }

    public static function typesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::TYPE_NEWS,
                'name' => trans('lists.articles_types.' . self::TYPE_NEWS . '.name'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }

    public static function statusesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::STATUS_PUBLISHED,
                'name' => trans('lists.articles_statuses.' . self::STATUS_PUBLISHED . '.name'),
            ],
            [
                'key' => self::STATUS_UNPUBLISHED,
                'name' => trans('lists.articles_statuses.' . self::STATUS_UNPUBLISHED . '.name'),
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
}
