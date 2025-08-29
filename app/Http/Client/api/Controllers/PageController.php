<?php

namespace App\Http\Client\api\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    /**
     * @api {get} /page/:slug Показати сторінку за slug
     * @apiName ShowPage
     * @apiGroup Pages
     *
     * @apiParam {String} slug Slug сторінки
     *
     * @apiSuccess {Number} id ID сторінки
     * @apiSuccess {String} title Заголовок сторінки
     * @apiSuccess {String} slug Slug сторінки
     * @apiSuccess {String} content Контент сторінки
     * @apiSuccess {String} created_at Дата створення
     * @apiSuccess {String} updated_at Дата оновлення
     *
     * @apiSuccessExample {json} Відповідь успіху:
     * HTTP/1.1 200 OK
     * {
     *   "id": 1,
     *   "title": "Про нас",
     *   "slug": "about-us",
     *   "content": "<p>Тут контент сторінки...</p>",
     *   "created_at": "2025-08-28T10:00:00.000000Z",
     *   "updated_at": "2025-08-28T10:00:00.000000Z"
     * }
     */
    public function show(Page $page): JsonResponse
    {
        return response()->json($page);
    }
}
