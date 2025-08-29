<?php

namespace App\Http\Client\api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer' => ['required', 'array'],
            'customer.first_name' => ['required', 'string', 'max:255'],
            'customer.last_name' => ['required', 'string', 'max:255'],
            'customer.phone' => ['required', 'string', 'max:20'],
            'customer.email' => ['required', 'email', 'max:255'],
        ];
    }
}
