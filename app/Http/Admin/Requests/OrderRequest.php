<?php

namespace App\Http\Admin\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(Order::statusesList('key'))],
            'type' => ['required', Rule::in(Order::typesList('key'))],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'customer' => ['required', 'array'],
            'customer.first_name' => ['nullable', 'string', 'max:255'],
            'customer.last_name' => ['nullable', 'string', 'max:255'],
            'customer.email' => ['nullable', 'string', 'email:strict', 'max:255'],
            'customer.phone' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function getData(): array
    {
        return $this->only(['status', 'type', 'customer', 'user_id']);
    }
}
