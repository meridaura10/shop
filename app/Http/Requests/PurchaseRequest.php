<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_price' => ['nullable', 'numeric'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'integer'],
            'product_id' => ['nullable', 'integer', 'exists:products,id'],
        ];
    }

    public function getData(): array
    {
        return $this->only(['old_price', 'price', 'quantity', 'product_id']);
    }
}
