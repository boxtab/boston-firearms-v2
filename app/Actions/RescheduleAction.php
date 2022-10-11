<?php

namespace App\Actions;

use App\Models\Appointment;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

/**
 * Class RescheduleAction
 * @package App\Actions
 */
class RescheduleAction
{
    /**
     * @param Booking $booking
     * @param Appointment $newAppointment
     */
    public function handle(Booking $booking, Appointment $newAppointment)
    {
        DB::transaction(function () use ($booking, $newAppointment) {
            $newAppointment->update([
                'remaining_spots' => max($newAppointment->remaining_spots - 1, 0),
            ]);


            $booking->appointment->update([
                'remaining_spots' => $booking->appointment->remaining_spots + 1,
            ]);

            $booking->update([
                'appointment_id' => $newAppointment->id,
            ]);
        });
    }
}
