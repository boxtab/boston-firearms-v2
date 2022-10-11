<?php

namespace App\Http\Requests;

use App\Constants\PaymentConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AppointmentOneSaveRequest extends FormRequest
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
            'appointment' => ['required', 'array',],
            'appointment.event_date' => ['required', 'string', 'date_format:Y-m-d',],
            'appointment.start_time' => ['required', 'string',],
            'appointment.end_time' => ['required', 'string',],
            'appointment.spots' => ['required', 'integer', 'min:0',],
            'appointment.remaining_spots' => ['required', 'integer', 'min:0', 'lte:appointment.spots'],
            'appointment.registration_fee' => ['required', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/',],
            'appointment.deposit_fee' => ['required', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/',],
            'appointment.payment_type' => [
                'required',
                'integer',
                Rule::in(array_keys(PaymentConstants::TYPES)),
            ],
            'appointment.radiobutton_has_live_fire' => ['required', 'integer', 'between:1,2'],
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
            'appointment.event_date.required' => 'The date of the appointment must be filled in.',

            'appointment.start_time.required' => 'The appointment start time must be filled in.',

            'appointment.end_time.required' => 'The appointment end time must be filled in.',
            'appointment.end_time.date_format' => 'Incorrect format of the appointment end time.',

            'appointment.spots.required' => 'The spots field must be filled in.',
            'appointment.spots.min' => 'The spots field must be a positive number.',

            'appointment.remaining_spots.required' => 'The remaining spots field must be filled in.',
            'appointment.remaining_spots.min' => 'The remaining spots field must be a positive number.',
            'appointment.remaining_spots.lte' => 'The number of available seats should not exceed the number of shared seats.',

            'appointment.registration_fee.required' => 'The registration fee field must be filled in.',
            'appointment.registration_fee.min' => 'The registration fee must be greater than zero.',

            'appointment.deposit_fee.required' => 'The deposit fee field must be filled in.',
            'appointment.deposit_fee.min' => 'The deposit fee must be greater than zero.',

            'appointment.payment_type.required' => 'The payment type must be filled in.',
            'appointment.radiobutton_has_live_fire.required' => 'The live fire field must be filled in.',
        ];
    }
}
