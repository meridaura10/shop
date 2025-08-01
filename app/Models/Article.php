<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory, HasStaticLists;

    const TYPE_NEWS = 'news';

    protected $guarded = ['id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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
}
