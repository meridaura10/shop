<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, HasStaticLists;

    const TYPE_PRODUCT = 'product';

    const TYPE_ARTICLE = 'article';

    protected $guarded = ['id'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public static function typesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::TYPE_PRODUCT,
                'name' => trans('lists.category_types.' . self::TYPE_PRODUCT . '.name'),
            ],
            [
                'key' => self::TYPE_ARTICLE,
                'name' => trans('lists.category_types.' . self::TYPE_ARTICLE . '.name'),
            ],

        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }
}
