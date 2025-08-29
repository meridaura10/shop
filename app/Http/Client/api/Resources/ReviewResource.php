<?php

namespace App\Http\Client\api\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'rating' => $this->rating,

            'parent' => ReviewResource::make($this->whenLoaded('parent')),
            'children' => ReviewResource::collection($this->whenLoaded('children')),
        ];
    }
}
