<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * (The controller already restricts access by checking if the user is an Admin.)
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'            => 'required|string|max:50|min:3|regex:/^[a-zA-Z0-9 ]+$/',
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'lowercase',
            ],
            'password'        => 'required|string|min:8',
            'role'            => ['required', Rule::in(['Admin', 'Staff', 'User'])],
        ];
    }



    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'password.min' => 'The password must be at least :min characters.',
            'name.min' => 'The name must be at least :min characters.',
            'name.max' => 'The name must be at most :max characters.',
            'name.regex' => 'The name must contain only letters and numbers.',
        ];
    }
}
