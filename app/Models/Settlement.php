<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Settlement extends Model
{
    /** @use HasFactory<\Database\Factories\SettlementFactory> */
    use HasFactory;

    const TYPE_AREA = 'Area';

    const TYPE_REGION = 'Region';

    const TYPE_CITY = 'City';

    const TYPE_CITY_REGION = 'City Region';


    protected $guarded = ['id'];

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query
            ->when($filters['type'] ?? null, fn($q) => $q->where('type', $filters['type']))
            ->when($filters['area_id'] ?? null, fn($q) => $q->where('area_id', $filters['area_id']))
            ->when($filters['region_id'] ?? null, fn($q) => $q->where('region_id', $filters['region_id']))
            ->when($filters['city_id'] ?? null, fn($q) => $q->where('city_id', $filters['city_id']));

        return $query;
    }
}
