<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50', 'min:3', 'regex:/^[a-zA-Z0-9 ]+$/'],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'lowercase',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}
