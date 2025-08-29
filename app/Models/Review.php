<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory, HasStaticLists;

    protected $guarded = ['id'];

    const STATUS_PENDING = 'pending';

    const TYPE_PRODUCT = 'product';

    const STATUS_PUBLISHED = 'published';

    const STATUS_UNPUBLISHED = 'unpublished';

    const STATUS_REJECTED = 'rejected';

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function treeFor(Model $model): Collection
    {
        $reviews = static::query()
            ->where('model_id', $model->id)
            ->where('model_type', $model->getMorphClass())
            ->get();

        $grouped = $reviews->groupBy('parent_id');

        return static::buildTree(null, $grouped);
    }

    protected static function buildTree(?int $parentId,Collection|array $grouped): Collection
    {
        return collect($grouped[$parentId] ?? [])->map(function ($item) use ($grouped) {
            $item->setRelation('children', static::buildTree($item->id, $grouped));
            return $item;
        });
    }

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
                'name' => 'Опубліковано',
            ],
            [
                'key' => self::STATUS_UNPUBLISHED,
                'name' => 'Не опубліковано'
            ],
            [
                'key' => self::STATUS_REJECTED,
                'name' => 'Відхилино'
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }
}
