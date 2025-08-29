<?php

namespace App\Services\Favorite;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FavoriteService
{
    protected Collection $favorites;

    protected ?User $user;

    public function __construct()
    {
        $this->favorites = collect();
        $this->user = auth()->user();
    }

    public function toggle(Model $model): bool
    {
        $exists = $this->isFavorite($model);

        $exists ? $this->remove($model) : $this->add($model);

        return !$exists;
    }

    public function isFavorite(Model $model): bool
    {
        if (!$this->user){
            return false;
        }

        return $this->getFavorites()
            ->contains(function (Favorite $item) use ($model) {
                return $item->model_type === $model->getMorphClass() && $item->model_id === $model->id;
            });
    }

    public function add(Model $model): bool
    {
        $this->user?->favorites()->create([
            'model_type' => $model->getMorphClass(),
            'model_id' => $model->id,
        ]);

        return true;
    }

    public function remove(Model $model): bool
    {
        $this->user?->favorites()
            ->where('model_type', $model->getMorphClass())
            ->where('model_id', $model->id)
            ->delete();

        return false;
    }

    public function getFavorites(): Collection
    {
        if ($this->favorites->isNotEmpty()) {
            return $this->favorites;
        }

        return $this->favorites = $this->user->favorites;
    }

    public function setFavorites(Collection $favorites): static
    {
        $this->favorites = $favorites;

        return $this;
    }

    public function getTypeFavorites(string $model): Collection
    {
        return $this->getFavorites()->filter(function (Favorite $favorite) use ($model) {
            return $favorite->model_type === (new $model)->getMorphClass();
        });
    }
}
