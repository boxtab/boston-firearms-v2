<?php

namespace App\Http\Requests;

use App\Constants\BooleanConstant;
use App\Constants\PaymentConstants;
use App\Constants\PaymentViewConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AppointmentSaveRequest extends FormRequest
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
            'select_date' => ['required', 'array', 'size:2',],
            'select_date.start' => ['required', 'string', 'date_format:Y-m-d',],
            'select_date.end' => ['required', 'string', 'date_format:Y-m-d',],

            'appointments' => ['required', 'array', 'min:1'],
            'appointments.*' => ['required', 'array'],
            'appointments.*.start_time' => ['required',],
            'appointments.*.end_time' => ['required',],
            'appointments.*.spots' => ['required', 'min:1'],
            'appointments.*.amount' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'appointments.*.payment_type' => [
                'required',
                Rule::in(
                    array_keys(PaymentConstants::APPOINTMENT_PAYMENT_OPTIONS)
                ),
            ],
            'appointments.*.has_live_fire' => [
                'required',
                Rule::in(
                    array_keys(BooleanConstant::YES_NO)
                )
            ],
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
            'select_date.start.required' => 'The start date field must be filled in.',
            'select_date.start.date_format' => 'The start date has the wrong format.',

            'select_date.end.required' => 'The end date field must be filled in.',
            'select_date.end.date_format' => 'The end date has the wrong format.',

            'appointments.*.start_time.required' => 'The appointment start time field must be filled in.',
            'appointments.*.end_time.required' => 'The appointment end time field must be filled in.',

            'appointments.*.spots.required' => 'The appointment spot field must be filled in.',
            'appointments.*.spots.min' => 'At least one appointment must be specified.',

            'appointments.*.amount.required' => 'The appointment amount field must be filled in.',
        ];
    }
}
