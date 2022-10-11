<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ContactUsRequest extends FormRequest
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
            'contact_us.first_name' => ['required', 'string', 'max:255'],
            'contact_us.last_name'  => ['required', 'string', 'max:255'],
            'contact_us.phone'      => ['required', 'string', 'max:64'],
            'contact_us.email'      => ['required', 'string', 'min:5', 'max:255', 'email:rfc,dns'],
            'contact_us.message'    => ['required', 'string'],
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
            'contact_us.first_name.required' => 'The first name field must be filled in.',
            'contact_us.first_name.max' => 'The first name field is too long.',

            'contact_us.last_name.required' => 'The last name field must be filled in.',
            'contact_us.last_name.max' => 'The last name field is too long.',

            'contact_us.phone.required' => 'The phone field must be filled in.',
            'contact_us.phone.max' => 'The phone field is too long.',

            'contact_us.email.required' => 'The email field must be filled in.',
            'contact_us.email.min' => 'The email field is too short.',
            'contact_us.email.max' => 'The email field is too long.',
            'contact_us.email.email' => 'Invalid email format field.',

            'contact_us.message.required' => 'The message field must be filled in.',
        ];
    }
}
