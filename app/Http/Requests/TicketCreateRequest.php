<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
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
            'title'            => 'required|string|max:50|min:3|regex:/^[a-zA-Z0-9 ]+$/',
            'product' => [
                'nullable',
                'max:25',
            ],
            'server_info'        => 'nullable|string|min:8',
            'message'            => ['required', 'string', 'max:350', 'min:10'],
        ];
    }



    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'title.min' => 'The name must be at least :min characters.',
            'title.max' => 'The name must be at most :max characters.',
            'product.max' => 'The name must be at most :max characters.',

            'name.regex' => 'The name must contain only letters and numbers.',
        ];
    }
}
