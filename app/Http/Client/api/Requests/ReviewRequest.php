<?php

namespace App\Http\Client\api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string', 'max:2048'],
            'email' => ['nullable', 'email', 'max:255'],
        ];
    }
}
