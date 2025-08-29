<?php

namespace App\Http\Client\api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'address' => ['required', 'exists:settlements,id'],
        ];
    }
}
