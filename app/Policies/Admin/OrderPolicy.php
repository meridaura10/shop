<?php

namespace App\Policies\Admin;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('order.viewAny');
    }

    public function create(User $user): bool
    {
        return $user->can('order.create');
    }

    public function update(User $user, Order $order): bool
    {
        return $user->can('order.update');
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->can('order.delete');
    }
}
