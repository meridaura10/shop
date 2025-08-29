<?php

namespace App\Http\Client\api\Resources;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
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
            'user' => UserResource::make($this->whenLoaded('user')),
            'model' => $this->whenLoaded('model', function () {
                if ($this->model instanceof Product) {
                    return ProductResource::make($this->model);
                }

                if ($this->model instanceof Article) {
                    return ArticleResource::make($this->model);
                }

                return [
                    'id' => $this->model->id,
                    'type' => $this->model_type,
                    'name' => $this->model->name ?? null,
                ];
            }),
        ];
    }
}
