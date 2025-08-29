<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory, HasStaticLists, HasUuid;

    const STATUS_PENDING = 'pending';

    const STATUS_FAILED = 'failed';

    const STATUS_COMPLETED = 'completed';

    const SYSTEM_LIQPAY = 'LiqPay';

    protected $guarded = ['id'];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

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
