<?php

namespace App\Http\Admin\Requests;

use App\Http\Requests\Traits\SeoRulesTrait;
use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    use SeoRulesTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2048'],
            'status' => ['required', Rule::in(Page::statusesList('key'))],
            'content' => ['nullable', 'string'],

            ...$this->seoRules(),
        ];
    }

    public function getData(): array
    {
        return $this->except($this->exceptSeoRules());
    }
}
