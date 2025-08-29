<?php

namespace App\Http\Admin\Requests;

use App\Http\Requests\Traits\SeoRulesTrait;
use App\Models\Term;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TermRequest extends FormRequest
{
    use SeoRulesTrait;
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'status' => ['required', Rule::in(Term::statusesList('key'))],

            ...$this->seoRules(),
        ];
    }

    public function getData(): array
    {
        return $this->except($this->exceptSeoRules());
    }
}
