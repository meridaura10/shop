<?php

namespace App\Http\Client\api\Controllers;

use App\Http\Client\api\Resources\ProductResource;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * @api {get} /products Отримати список продуктів
     * @apiName GetProducts
     * @apiGroup Products
     *
     * @apiDescription Повертає список продуктів з пагінацією, можливі фільтри.
     *
     * @apiParam {Number} [page=1] Номер сторінки.
     * @apiParam {Number} [per_page=15] Кількість елементів на сторінці.
     * @apiParam {String} [category] Фільтр по категорії.
     * @apiParam {String} [brand] Фільтр по бренду.
     *
     * @apiSuccess {Object[]} data Список продуктів.
     * @apiSuccess {Number} data.id ID продукту.
     * @apiSuccess {String} data.name Назва продукту.
     * @apiSuccess {String} data.slug Slug продукту.
     * @apiSuccess {String} data.description Опис продукту.
     * @apiSuccess {Boolean} data.is_favorite Чи доданий у вибране.
     * @apiSuccess {Object} data.category Категорія продукту.
     * @apiSuccess {Object} data.brand Бренд продукту.
     *
     * @apiSuccessExample {json} Успішна відповідь:
     *  {
     *    "data": [
     *      {
     *        "id": 1,
     *        "name": "iPhone 15",
     *        "slug": "iphone-15",
     *        "description": "Новий Apple iPhone 15",
     *        "is_favorite": false,
     *        "category": { "id": 1, "name": "Смартфони" },
     *        "brand": { "id": 1, "name": "Apple" }
     *      }
     *    ],
     *    "meta": {
     *      "current_page": 1,
     *      "last_page": 10,
     *      "per_page": 15,
     *      "total": 150
     *    }
     *  }
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $products = Product::query()
            ->with('category', 'brand', 'media')
            ->active()
            ->filter($request->all())
            ->paginate();

        return ProductResource::collection($products);
    }

    /**
     * @api {get} /products/:slug Отримати один продукт
     * @apiName GetProduct
     * @apiGroup Products
     *
     * @apiDescription Повертає деталі продукту за його slug.
     *
     * @apiParam {String} slug Унікальний slug продукту.
     *
     * @apiSuccess {Number} id ID продукту.
     * @apiSuccess {String} name Назва продукту.
     * @apiSuccess {String} slug Slug продукту.
     * @apiSuccess {String} description Опис продукту.
     * @apiSuccess {Boolean} is_favorite Чи доданий у вибране.
     * @apiSuccess {Object[]} categories Список категорій.
     * @apiSuccess {Object[]} characteristics Характеристики продукту.
     */
    public function show(Product $product): ProductResource
    {
        $product->load('category', 'brand', 'media', 'categories', 'characteristics.attribute');

        return ProductResource::make($product);
    }

    /**
     * @api {get} /products/search Пошук продуктів
     * @apiName SearchProducts
     * @apiGroup Products
     *
     * @apiDescription Пошук продуктів по ключовому слову.
     *
     * @apiQuery {String} q Рядок для пошуку (назва, опис)
     *
     * @apiSuccess {Object[]} data Список продуктів.
     *
     * @apiError (400) MissingQuery Параметр q є обов'язковим.
     */
    public function search(Request $request): AnonymousResourceCollection
    {
        $search = $request->input('q');

        $products = Product::query()
            ->with('category', 'brand', 'media')
            ->active()
            ->search($search)
            ->paginate();

        return ProductResource::collection($products);
    }

    /**
     * @api {post} /products/:id/favorites Додати/зняти з вибраного
     * @apiName ToggleFavorite
     * @apiGroup Products
     * @apiPermission user
     *
     * @apiDescription Тогл для додавання або видалення продукту з вибраного.
     *
     * @apiParam {Number} id ID продукту.
     *
     * @apiSuccess {Number} id ID продукту.
     * @apiSuccess {String} name Назва продукту.
     * @apiSuccess {Boolean} is_favorite Новий стан вибраного.
     *
     * @apiError (401) Unauthorized Якщо користувач не авторизований.
     */
    public function favoriteToggle(Product $product): ProductResource
    {
        favorite()->toggle($product);

        return ProductResource::make($product);
    }
}
