<?php

namespace App\Http\Client\api\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'quantity' => $this->quantity,

            'product' => ProductResource::make($this->whenLoaded('product')),
            'order' => OrderResource::make($this->whenLoaded('order')),
        ];
    }
}
