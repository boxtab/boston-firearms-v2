<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendGridRequest extends FormRequest
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
            'sendgrid.api_key' => 'nullable|string|max:128',
            'sendgrid.email_from' => 'nullable|string|max:128',
            'sendgrid.email_admin' => 'nullable|string|max:128',

            'sendgrid.template_id_admin' => 'nullable|string|max:64',
            'sendgrid.template_id_client' => 'nullable|string|max:64',
            'sendgrid.template_id_upcoming' => 'nullable|string|max:64',
            'sendgrid.template_id_contact_us' => 'nullable|string|max:64',
            'sendgrid.template_id_sign_up_class' => 'nullable|string|max:64',
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
            'sendgrid.api_key.max' => 'The api key field is too long.',
            'sendgrid.email_from.max' => 'The email from field is too long.',
            'sendgrid.email_admin.max' => 'The email admin field is too long.',
            'sendgrid.template_id_admin.max' => 'The template id admin field is too long.',
            'sendgrid.template_id_client.max' => 'The template id client field is too long.',
            'sendgrid.template_id_upcoming.max' => 'The template id upcoming field is too long.',
            'sendgrid.template_id_contact_us.max' => 'The template id contact us field is too long.',
            'sendgrid.template_id_sign_up_class.max' => 'The template id sign up class field is too long.',
        ];
    }
}
