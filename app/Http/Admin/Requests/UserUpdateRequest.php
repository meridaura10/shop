<?php

namespace App\Http\Admin\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'status' => ['nullable', Rule::in(User::statusesList('key'))],
            'role' => ['nullable', 'exists:roles,id'],
        ];
    }

    public function getData(): array
    {
        return $this->except([
            'categories',
            'characteristics',
        ]);
    }
}
