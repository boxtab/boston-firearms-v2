<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'email' => 'required|email:rfc,dns|min:5|max:255',
            'date_of_birth' => 'required|date_format:Y-m-d',
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
            'email.required' => 'The email field must be filled in.',
            'email.min' => 'The email field is too short.',
            'email.max' => 'The email field is too long.',
            'email.email' => 'Invalid email format field.',

            'date_of_birth.required' => 'The date of birth field must be filled in.',
            'date_of_birth.date_format' => 'Date of birth is incorrect.',
        ];
    }
}
