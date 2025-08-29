<?php

namespace App\Http\Client\api\Controllers;

use App\Http\Client\api\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * @api {get} /categories Список категорій продуктів
     * @apiName CategoriesIndex
     * @apiGroup Categories
     *
     * @apiSuccess {Object[]} data Список категорій
     * @apiSuccess {Number} data.id ID категорії
     * @apiSuccess {String} data.name Назва категорії
     * @apiSuccess {String} data.slug Slug категорії
     * @apiSuccess {String} data.body Опис категорії
     * @apiSuccess {Boolean} data.status Статус активності
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Term::whereProductCategories()->active()->get();

        return CategoryResource::collection($categories);
    }

    /**
     * @api {get} /categories/:slug Перегляд категорії
     * @apiName CategoriesShow
     * @apiGroup Categories
     *
     * @apiParam {String} slug Slug категорії в URL
     *
     * @apiSuccess {Number} id ID категорії
     * @apiSuccess {String} name Назва категорії
     * @apiSuccess {String} slug Slug категорії
     * @apiSuccess {String} body Опис категорії
     * @apiSuccess {Boolean} status Статус активності
     */
    public function show(Term $term): CategoryResource
    {
        return CategoryResource::make($term);
    }
}
