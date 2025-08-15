<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
            'slug' => ['nullable', 'string', 'max:255', 'unique:articles,slug'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'weight' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', Rule::in(Article::statusesList('key'))],
            'type' => ['required', Rule::in(Article::typesList('key'))],
            'images' => ['array'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->input('weight') == null) {
            $this->merge(['weight' => 0]);
        }
    }
}
