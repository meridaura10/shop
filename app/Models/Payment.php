<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory, HasStaticLists;

    protected $guarded = ['id'];

    const STATUS_PENDING = 'pending';

    const SYSTEM_FONDY = 'fondy';

    const TYPE_CARD = 'card';

    const TYPE_CASH = 'cash';

    protected $attributes = [
        'status' => self::STATUS_PENDING,
        'type' => self::TYPE_CASH,
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
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

    /**
     * @param string|null $columnKey
     * @param string|null $indexKey
     * @return array
     */
    public static function typesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::TYPE_CASH,
                'name' => trans('lists.order_types.' . self::TYPE_CASH . '.name'),
            ],

        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }

    /**
     * @param string|null $columnKey
     * @param string|null $indexKey
     * @return array
     */
    public static function systemsList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::SYSTEM_FONDY,
                'name' => trans('lists.order_systems.' . self::SYSTEM_FONDY . '.name'),
            ],

        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }
}
