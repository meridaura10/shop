<?php

namespace App\Http\Client\api\Controllers;

use App\Http\Client\api\Requests\ReviewRequest;
use App\Http\Client\api\Resources\ReviewResource;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductReviewCollection extends Controller
{
    /**
     * @api {get} /products/:id/reviews Список відгуків продукту
     * @apiName ProductReviews
     * @apiGroup Products
     *
     * @apiParam {Number} id ID продукту
     *
     * @apiSuccess {Number} id ID відгуку
     * @apiSuccess {String} name Ім'я автора
     * @apiSuccess {String} description Текст відгуку
     * @apiSuccess {Number} user_id ID користувача (може бути null)
     * @apiSuccess {String} created_at Дата створення
     * @apiSuccess {String} updated_at Дата оновлення
     *
     * @apiSuccessExample {json} Відповідь успіху:
     * HTTP/1.1 200 OK
     * [
     *   {
     *     "id": 1,
     *     "name": "Іван",
     *     "description": "Чудовий продукт!",
     *     "user_id": 5,
     *     "created_at": "2025-08-28T10:00:00.000000Z",
     *     "updated_at": "2025-08-28T10:00:00.000000Z"
     *   }
     * ]
     */
    public function index(Product $product): AnonymousResourceCollection
    {
        return ReviewResource::collection($product->reviews()->get());
    }

    /**
     * @api {post} /products/:id/reviews Додати відгук
     * @apiName StoreProductReview
     * @apiGroup Products
     *
     * @apiParam {Number} id ID продукту
     * @apiBody  {String} name Ім'я автора
     * @apiBody {String} body Текст відгуку
     * @apiBody  {String} [email] Email користувача (якщо зареєстрований)
     *
     * @apiSuccess {Number} id ID відгуку
     * @apiSuccess {String} name Ім'я автора
     * @apiSuccess {String} description Текст відгуку
     * @apiSuccess {Number} user_id ID користувача (може бути null)
     * @apiSuccess {String} created_at Дата створення
     * @apiSuccess {String} updated_at Дата оновлення
     *
     * @apiSuccessExample {json} Відповідь успіху:
     * HTTP/1.1 201 Created
     * {
     *   "id": 10,
     *   "name": "Марія",
     *   "description": "Дуже сподобався продукт",
     *   "user_id": null,
     *   "created_at": "2025-08-28T11:00:00.000000Z",
     *   "updated_at": "2025-08-28T11:00:00.000000Z"
     * }
     */
    public function store(ReviewRequest $request, Product $product): ReviewResource
    {
        $user = $request->email ? User::query()->where('email', $request->email)->first() : null;

        $review = $product->reviews()->create([
            'name' => $request->name,
            'description' => $request->body,
            'user_id' => $user?->id,
        ]);

        return ReviewResource::make($review);
    }
}
