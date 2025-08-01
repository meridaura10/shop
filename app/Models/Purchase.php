<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Purchase extends Model
{
    /** @use HasFactory<\Database\Factories\PurchasesFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['amount'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn () => round($this->price * $this->quantity,2),
        );
    }
}
