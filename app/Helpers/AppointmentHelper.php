<?php

namespace App\Helpers;

use App\Constants\PaymentConstants;
use App\Models\Appointment;


/**
 * Class AppointmentHelper
 * @package App\Helpers
 */
class AppointmentHelper
{


    /**
     * @param Appointment $appointment
     * @return mixed
     */
    public static function getRegistrationFee(Appointment $appointment)
    {
        return $appointment->registration_fee;
    }

    /**
     * @param Appointment $appointment
     * @return int
     */
    public static function getDepositFee(Appointment $appointment)
    {
        /*
         * Full payment = 1
         * Deposit = 2
         * Cash = 3
         */
        return $appointment->payment_type == PaymentConstants::APPOINTMENT_PAYMENT_OPTION_DEPOSIT
            ? $appointment->deposit_fee
            : $appointment->registration_fee;
    }

    /**
     * @param $appointmentId
     * @return false|string
     */
    public static function getStartTime($appointmentId)
    {
        $appointment = Appointment::on()->findOrFail($appointmentId);

        return date('h:i A', strtotime($appointment->start_time));
    }
}
