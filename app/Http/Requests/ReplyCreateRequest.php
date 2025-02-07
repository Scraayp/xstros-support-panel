<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyCreateRequest extends FormRequest
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
            'message'            => ['required', 'string', 'max:350', 'min:10'],
        ];
    }



    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'message.max' => 'The message must be at most :max characters.',
            'message.min' => 'The message must be at least :min characters.',
        ];
    }
}
