<?php

namespace App\Policies\Admin;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('article.viewAny');
    }

    public function create(User $user): bool
    {
        return $user->can('article.create');
    }

    public function update(User $user, Article $article): bool
    {
        return $user->can('article.update');
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->can('article.delete');
    }
}
