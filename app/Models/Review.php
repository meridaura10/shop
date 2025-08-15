<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory, HasStaticLists;

    protected $guarded = ['id'];

    const STATUS_PENDING = 'pending';

    const TYPE_PRODUCT = 'product';

    const STATUS_PUBLISHED = 'published';

    const STATUS_UNPUBLISHED = 'unpublished';

    protected $attributes = [
      'status' => self::STATUS_PENDING,
      'type' => self::TYPE_PRODUCT,
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function children(): HasMany
    {
        return $this->hasMany(Review::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }

    /**
     * @param string|null $columnKey
     * @param string|null $indexKey
     * @return array
     */
    public static function typesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::TYPE_PRODUCT,
                'name' => trans('lists.order_statuses.' . self::TYPE_PRODUCT . '.name'),
            ],

        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }

    public static function statusesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::STATUS_PUBLISHED,
                'name' => trans('lists.reviews_statuses.' . self::STATUS_PUBLISHED . '.name'),
            ],
            [
                'key' => self::STATUS_UNPUBLISHED,
                'name' => trans('lists.reviews_statuses.' . self::STATUS_UNPUBLISHED . '.name'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }
}
