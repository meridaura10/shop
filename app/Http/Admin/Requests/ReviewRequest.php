<?php

namespace App\Http\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'model_type' => ['required', 'string'],
            'model_id' => [
                'required',
                'integer',
                Rule::exists((new (request('model_type')))->getTable(), 'id'),
            ],
            'description' => ['required', 'string', 'max:2048'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'parent_id' => ['nullable', 'string', 'integer', 'exists:reviews,id'],
        ];
    }

    public function getData(): array
    {
        $model = $this->request->get('model_type');

        $data = $this->except('model_type');

        $data['model_type'] = (new $model)->getMorphClass();

        return $data;
    }
}
