<?php

namespace App\Http\Client\api\Controllers;

use App\Http\Client\api\Requests\LeadRequest;
use App\Http\Client\api\Resources\LeadResource;
use App\Http\Controllers\Controller;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * @api {post} /subscription Створити підписку
     * @apiName SubscriptionStore
     * @apiGroup Subscription
     *
     * @apiBody  (Request body) {String} email Email користувача
     *
     * @apiSuccess {Number} id ID підписки
     * @apiSuccess {Object} fields Поля підписки
     * @apiSuccess {String} fields.email Email користувача
     * @apiSuccess {String} created_at Дата створення
     * @apiSuccess {String} updated_at Дата оновлення
     *
     * @apiSuccessExample {json} Відповідь успіху:
     *  HTTP/1.1 201 Created
     *  {
     *      "id": 1,
     *      "fields": {
     *          "email": "example@mail.com"
     *      },
     *      "created_at": "2025-08-28T10:00:00.000000Z",
     *      "updated_at": "2025-08-28T10:00:00.000000Z"
     *  }
     */
    public function store(LeadRequest $request): LeadResource
    {
        $lead = Lead::query()->create([
            'fields' => [
                'email' => $request->get('email'),
            ],
        ]);

        return new LeadResource($lead);
    }
}
