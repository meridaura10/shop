<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    public function create(User $user): bool
    {
        return auth()->check();
    }

    public function update(User $user, Review $review): bool
    {
        return $this->isAuthor($user, $review);
    }

    public function delete(User $user, Review $review): bool
    {
        return $this->isAuthor($user, $review);
    }

    public function isAuthor(User $user, Review $review): bool
    {
        return $review->user_id == $user->id;
    }
}
