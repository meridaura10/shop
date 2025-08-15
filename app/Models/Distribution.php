<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Distribution extends Model
{
    /** @use HasFactory<\Database\Factories\DistributionFactory> */
    use HasFactory, HasStaticLists;

    const STATUS_PENDING = 'pending';

    const STATUS_CONFIRMED = 'confirmed';

    protected $guarded = ['id'];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    public function casts(): array
    {
        return [
            'send_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function statusesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::STATUS_PENDING,
                'name' => trans('lists.distributions_statuses.' . self::STATUS_PENDING . '.name'),
            ],
            [
                'key' => self::STATUS_CONFIRMED,
                'name' => trans('lists.distributions_statuses.' . self::STATUS_CONFIRMED . '.name'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }
}
