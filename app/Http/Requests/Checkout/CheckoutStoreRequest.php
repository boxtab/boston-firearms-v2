<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CheckoutStoreRequest extends FormRequest
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
            'booking.booking_id' => ['sometimes', 'nullable', 'exists:bookings,id'],
            'booking.appointment_id' => ['sometimes', 'nullable', 'exists:appointments,id'],
            'booking.client_id' => ['sometimes', 'nullable', 'exists:clients,id'],
            'booking.client.first_name' => ['required', 'string', 'max:255'],
            'booking.client.last_name' => ['required', 'string', 'max:255'],
            'booking.client.date_of_birth' => ['required', 'date'],
            'booking.client.phone' => ['required', 'string', 'max:64'],
            'booking.client.email' => ['required', 'string', 'min:5', 'max:255', 'email:rfc,dns'],
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
            'booking.client.first_name.required' => 'The first name field must be filled in.',
            'booking.client.first_name.max' => 'The first name is too long.',

            'booking.client.last_name.required' => 'The last name field must be filled in.',
            'booking.client.last_name.max' => 'The last name is too long.',

            'booking.client.date_of_birth.required' => 'The date of birth field must be filled in.',
            'booking.client.date_of_birth.date' => 'Date of birth must be of the date type.',

            'booking.client.phone.required' => 'The phone field must be filled in.',
            'booking.client.phone.max' => 'The phone number is too long.',

            'booking.client.email.required' => 'The email field must be filled in.',
            'booking.client.email.min' => 'Short email address.',
            'booking.client.email.max' => 'The email is too long.',
            'booking.client.email.email' => 'Invalid email format.',
        ];
    }
}
