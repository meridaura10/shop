<?php

namespace App\Http\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer' => ['required', 'array'],
            'customer.first_name' => ['required', 'string', 'max:255'],
            'customer.last_name' => ['required', 'string', 'max:255'],
            'customer.phone' => ['required', 'string', 'max:20'],
            'customer.email' => ['required', 'email', 'max:255'],
            'area_id' => ['required', 'integer', 'exists:settlements,id'],
            'city_id' => ['nullable', 'integer', 'exists:settlements,id'],
            'region_id' => ['required', 'integer', 'exists:settlements,id'],
            'city_region_id' => ['nullable', 'integer', 'exists:settlements,id'],
        ];
    }
}
