<?php

namespace App\Http\Client\api\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'amount' => $this->amount,
            'status' => $this->status,
            'type' => $this->type,
            'customer' => $this->customer,
            'address' => SettlementResource::make($this->whenLoaded('address')),
            'user' => UserResource::make($this->whenLoaded('user')),
            'purchases' => PurchaseResource::collection($this->whenLoaded('purchases')),
        ];
    }
}
