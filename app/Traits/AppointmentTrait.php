<?php

namespace App\Traits;

use App\Constants\PaymentConstants;

/**
 * Trait AppointmentTrait
 * @package App\Traits
 */
trait AppointmentTrait
{
    /**
     * @param int $paymentType
     * @param float $amount
     * @param float $defaultFeePerEvent
     * @return array
     */
    private function getFee(int $paymentType, float $amount, float $defaultFeePerEvent)
    {
        $foo = [];

        if ($paymentType == PaymentConstants::APPOINTMENT_PAYMENT_OPTION_FULL_PAYMENT) {
            $foo = [
                'registration_fee' => $amount,
                'deposit_fee' => 0,
            ];
        }

        if ($paymentType == PaymentConstants::APPOINTMENT_PAYMENT_OPTION_DEPOSIT) {
            $foo = [
                'registration_fee' => $defaultFeePerEvent,
                'deposit_fee' => $amount,
            ];
        }

        if ($paymentType == PaymentConstants::APPOINTMENT_PAYMENT_OPTION_CASH) {
            $foo = [
                'registration_fee' => $defaultFeePerEvent,
                'deposit_fee' => 0,
            ];
        }

        return $foo;
    }
}
