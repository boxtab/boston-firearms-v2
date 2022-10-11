<?php

namespace App\Models\Traits\Method;

use App\Constants\PaymentConstants;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Trait AppointmentMethod
 * @package App\Models\Traits\Method
 */
trait AppointmentMethod
{
    /**
     * @return bool
     */
    public function isDepositAllowed(): bool
    {
        return (bool) $this->deposit_fee > 0;
    }

    public function getInitialAmount()
    {
        return $this->payment_type == PaymentConstants::APPOINTMENT_PAYMENT_OPTION_DEPOSIT ? $this->deposit_fee : $this->registration_fee;
    }

    /**
     * @return bool
     */
    public function isPast()
    {
        return Carbon::parse($this->start_time)->isPast();
    }
}
