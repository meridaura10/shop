<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'description' => ['nullable', 'string', 'max:2048'],
            'slug' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'string', Rule::in(Category::typesList('key'))],
            'status' => ['required', 'string', Rule::in(Category::statusesList('key'))],
            'weight' => ['nullable', 'integer', 'min:0', 'max:1000'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->input('parent_id') == 0) {
            $this->merge(['parent_id' => null]);
        }
    }
}
