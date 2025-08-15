<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Term;
use App\Models\User;
use App\Policies\Admin\ArticlePolicy;
use App\Policies\Admin\OrderPolicy;
use App\Policies\Admin\PagePolicy;
use App\Policies\Admin\ProductPolicy;
use App\Policies\Admin\RolePolicy;
use App\Policies\Admin\TermPolicy;
use App\Policies\Admin\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => ProductPolicy::class,
        Term::class => TermPolicy::class,
        Article::class => ArticlePolicy::class,
        User::class  => UserPolicy::class,
        Page::class => PagePolicy::class,
        Role::class => RolePolicy::class,
        Order::class => OrderPolicy::class,
    ];
}
