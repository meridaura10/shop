<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Головна', route('home'));
});

Breadcrumbs::for('catalog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Каталог', route('catalog.index'));
});

Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Блог', route('articles.index'));
});

Breadcrumbs::for('cart', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Кошик', route('cart.index'));
});

Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    if ($parent = $category->parent) {
        $trail->parent('category', $parent);
    } else {
        $trail->parent('catalog');
    }

    $trail->push($category->name, route('catalog.show', $category));
});

Breadcrumbs::for('article', function (BreadcrumbTrail $trail, $article) {
    $trail->parent('blog');
    $trail->push($article->name, route('articles.show', $article));
});

Breadcrumbs::for('product', function (BreadcrumbTrail $trail,$category, $product) {
    $trail->parent('category', $category);
    $trail->push($product->name, route('catalog.products.show',
        [
            'category' => $category, 'product' => $product
        ]
    ));
});

Breadcrumbs::for('page', function (BreadcrumbTrail $trail, $page) {
   $trail->parent('home');

   $trail->push($page->name, route('pages.show', $page));
});
