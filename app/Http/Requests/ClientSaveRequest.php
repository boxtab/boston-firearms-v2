<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'client.first_name'             => ['required', 'string', 'max:255'],
            'client.last_name'              => ['required', 'string', 'max:255'],
            'client.phone'                  => ['required', 'string', 'max:64'],
            'client.email'                  => ['required', 'string', 'min:5', 'max:255', 'email:rfc,dns'],
            'client.date_of_birth'          => ['nullable', 'string', 'date_format:Y-m-d'],
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
            'client.first_name.required' => 'The first name field must be filled in.',
            'client.first_name.max' => 'The first name field is too long.',

            'client.last_name.required' => 'The last name field must be filled in.',
            'client.last_name.max' => 'The last name field is too long.',

            'client.phone.required' => 'The phone field must be filled in.',
            'client.phone.max' => 'The phone field is too long.',

            'client.email.required' => 'The email field must be filled in.',
            'client.email.min' => 'The email field is too short.',
            'client.email.max' => 'The email field is too long.',
            'client.email.email' => 'Invalid email format field.',

            'client.date_of_birth.date_format' => 'Date of birth is incorrect.',
        ];
    }
}
