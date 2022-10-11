<?php

namespace App\Http\Requests\Checkout;

use App\Constants\PaymentConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CheckoutPaymentRequest extends FormRequest
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
            'booking_id' => ['required', 'integer', 'exists:bookings,id'],
            'type' => ['required', 'integer', 'in:' . implode(',', array_keys(PaymentConstants::TYPES))],
            'gateway' => ['required', 'integer', 'in:' . implode(',', array_keys(PaymentConstants::GATEWAYS))],
        ];
    }
}
