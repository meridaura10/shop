<?php

namespace App\Http\Client\api\Controllers;

use App\Http\Client\api\Requests\ProfileRequest;
use App\Http\Client\api\Resources\FavoriteResource;
use App\Http\Client\api\Resources\OrderResource;
use App\Http\Client\api\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MyController extends Controller
{
    /**
     * @api {get} /my/profile Отримати профіль користувача
     * @apiName Profile
     * @apiGroup My
     *
     * @apiSuccess {Number} id ID користувача
     * @apiSuccess {String} name Ім'я
     * @apiSuccess {String} email Email
     * @apiSuccess {String} created_at Дата створення
     * @apiSuccess {String} updated_at Дата оновлення
     *
     * @apiSuccessExample {json} Відповідь успіху:
     * HTTP/1.1 200 OK
     * {
     *   "id": 1,
     *   "name": "John Doe",
     *   "email": "example@mail.com",
     *   "created_at": "2025-08-28T10:00:00.000000Z",
     *   "updated_at": "2025-08-28T10:00:00.000000Z"
     * }
     */
    public function profile(): UserResource
    {
        return UserResource::make(auth()->user());
    }

    /**
     * @api {post} /my/profile Оновити профіль користувача
     * @apiName UpdateProfile
     * @apiGroup My
     *
     * @apiBody  (Request body) {String} name Ім'я користувача
     * @apiBody  (Request body) {String} email Email користувача
     * @apiBody  (Request body) {String} password password користувача
     * @apiBody  (Request body) {String} [password_confirmed] password_confirmed користувача
     * @apiBody  (Request body) {String} [phone] phone користувача
     * @apiBody  (Request body) {file} [avatar] avatar користувача
     *
     * @apiSuccess {Number} id ID користувача
     * @apiSuccess {String} name Ім'я
     * @apiSuccess {String} email Email
     * @apiSuccess {String} created_at Дата створення
     * @apiSuccess {String} updated_at Дата оновлення
     *
     * @apiSuccessExample {json} Відповідь успіху:
     * HTTP/1.1 200 OK
     * {
     *   "id": 1,
     *   "name": "John Doe",
     *   "email": "example@mail.com",
     *   "created_at": "2025-08-28T10:00:00.000000Z",
     *   "updated_at": "2025-08-28T10:05:00.000000Z"
     * }
     */
    public function updateProfile(ProfileRequest $request): UserResource
    {
        $user = auth()->user();
        $user->update($request->validated());

        return UserResource::make($user);
    }

    /**
     * @api {get} /my/orders Отримати замовлення користувача
     * @apiName Orders
     * @apiGroup My
     *
     * @apiSuccess {Object[]} orders Список замовлень
     * @apiSuccess {Number} orders.id ID замовлення
     * @apiSuccess {Object[]} orders.purchases Товари в замовленні
     *
     * @apiSuccessExample {json} Відповідь успіху:
     * HTTP/1.1 200 OK
     * [
     *   {
     *     "id": 1,
     *     "purchases": [
     *       {
     *         "id": 10,
     *         "name": "Product Name"
     *       }
     *     ]
     *   }
     * ]
     */
    public function orders(): AnonymousResourceCollection
    {
        $orders = auth()->user()->orders()->with('purchases.media')->get();
        return OrderResource::collection($orders);
    }

    /**
     * @api {get} /my/favorites Отримати обрані товари користувача
     * @apiName Favorites
     * @apiGroup My
     *
     * @apiSuccess {Object[]} favorites Список обраних товарів
     * @apiSuccess {Number} favorites.id ID товару
     * @apiSuccess {String} favorites.name Назва товару
     * @apiSuccess {String} favorites.slug Slug товару
     *
     * @apiSuccessExample {json} Відповідь успіху:
     * HTTP/1.1 200 OK
     * [
     *   {
     *     "id": 1,
     *     "name": "Product Name",
     *     "slug": "product-name"
     *   }
     * ]
     */
    public function favorites(): AnonymousResourceCollection
    {
        $favorites = auth()->user()->favorites()->with('model.media')->get();
        return FavoriteResource::collection($favorites);
    }
}
