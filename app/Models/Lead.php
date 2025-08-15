<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lead extends Model
{
    /** @use HasFactory<\Database\Factories\LeadFactory> */
    use HasFactory, HasStaticLists, Notifiable;

    const STATUS_PUBLISHED = 'published';

    const STATUS_UNPUBLISHED = 'unpublished';

    protected $guarded = ['id'];

    public function casts(): array
    {
        return [
            'fields' => 'array',
        ];
    }

    public function routeNotificationForMail(): null|string
    {
        return $this->fields['email'] ?? null;
    }

    public function routeNotificationForSmsru(): null|string
    {
        return $this->fields['phone'] ?? null;
    }

    public static function statusesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::STATUS_PUBLISHED,
                'name' => trans('lists.leads_statuses.' . self::STATUS_PUBLISHED . '.name'),
            ],
            [
                'key' => self::STATUS_UNPUBLISHED,
                'name' => trans('lists.leads_statuses.' . self::STATUS_UNPUBLISHED . '.name'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }
}
