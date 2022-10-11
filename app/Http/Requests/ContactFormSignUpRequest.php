<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormSignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'             => ['required', 'string', 'max:255'],
            'last_name'              => ['required', 'string', 'max:255'],
            'email'                  => ['required', 'string', 'min:5', 'max:255', 'email:rfc,dns'],
            'message'                => ['sometimes', 'string'],
            'event_id'               => ['required', 'exists:events,id']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name field must be filled in.',
            'first_name.max' => 'The first name field is too long.',

            'last_name.required' => 'The last name field must be filled in.',
            'last_name.max' => 'The last name field is too long.',

            'email.required' => 'The email field must be filled in.',
            'email.min' => 'The email field is too short.',
            'email.max' => 'The email field is too long.',
            'email.email' => 'Invalid email format field.',
        ];
    }
}
