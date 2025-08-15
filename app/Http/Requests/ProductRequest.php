<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2048'],
            'old_price' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric'],
            'quantity' => ['required', 'integer'],
            'status' => ['required', 'string', Rule::in(Product::statusesList('key'))],
            'category_id' => ['required', 'exists:terms,id'],
            'brand_id' => ['nullable', 'exists:terms,id'],

            'categories' => ['array'],
            'categories.*' => ['integer', 'exists:terms,id'],

            'characteristics' => ['array'],
            'characteristics.*' => ['integer', 'nullable', 'exists:characteristics,id'],
        ];
    }

    public function getData(): array
    {
        return $this->except([
            'categories',
            'characteristics',
        ]);
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'price' => $this->input('price') ?? 0,
            'old_price' => $this->input('old_price') ?? 0,
        ]);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $price = $this->input('price');
            $oldPrice = $this->input('old_price');

            if (!empty($oldPrice) && $oldPrice != 0 && $price >= $oldPrice) {
                $validator->errors()->add('price', 'Ціна має бути меншою за стару ціну.');
            }
        });
    }
}
