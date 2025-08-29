<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;

class PagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('page.viewAny');
    }

    public function create(User $user): bool
    {
        return $user->can('page.create');
    }

    public function update(User $user, Page $page): bool
    {
        return $user->can('page.update');
    }

    public function delete(User $user, Page $page): bool
    {
        return $user->can('page.delete');
    }
}
