<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory, HasStaticLists;

    const STATUS_PENDING = 'pending';

    const TYPE_ORDER = 'order';

    const TYPE_BASKET = 'basket';

    protected $guarded = ['id'];

    protected $attributes = [
       'status' => self::STATUS_PENDING,
       'type' => self::TYPE_BASKET,
    ];

    public function casts(): array
    {
        return [
           'customer' => 'array',
            'address' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function payment(): MorphOne
    {
        return $this->morphOne(Payment::class, 'model');
    }

    /**
     * @param string|null $columnKey
     * @param string|null $indexKey
     * @return array
     */
    public static function statusesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::STATUS_PENDING,
                'name' => trans('lists.order_statuses.' . self::STATUS_PENDING . '.name'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }

    public static function typesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::TYPE_BASKET,
                'name' => trans('lists.order_types.' . self::TYPE_BASKET . '.name'),
            ],
            [
                'key' => self::TYPE_ORDER,
                'name' => trans('lists.order_types.' . self::TYPE_ORDER . '.name'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }
}
