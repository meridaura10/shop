<?php

namespace App\Http\Admin\Requests;

use App\Models\Review;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReviewPutRequest extends FormRequest
{
    public function rules():array
    {
        return [
            'status' => [Rule::in(Review::statusesList('key'))],
        ];
    }
}
