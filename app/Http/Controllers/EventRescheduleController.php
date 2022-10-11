<?php

namespace App\Http\Controllers;

use App\Helpers\HashHelper;
use App\Http\Resources\CalendarAppointmentsListResource;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Event;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Class EventRescheduleController
 * @package App\Http\Controllers
 */
class EventRescheduleController extends Controller
{
    /**
     * @param string $bookingHash
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $bookingHash)
    {
        try {
            $bookingId = HashHelper::decrypt($bookingHash);
            $booking = Booking::on()->find($bookingId);
        } catch (Exception $e) {
            abort(404);
        }

        return view('pages.event_reschedule', [
            'bookingHash' => $bookingHash,
            'class' => $booking->appointment->event,

            'appointments' => CalendarAppointmentsListResource::collection(
                (new AppointmentService())
                    ->getListByEventQuery($booking->appointment->event)
                    ->get()
            ),

            'courseTitle' => $booking->appointment->event->title,
            'courseDateTime' => $booking->appointment->reschedule_date_time,
            'dropDownEvents' => Event::active()->hasAppointments()->orderBy('id')->get(),
            'selectedEventId' => $booking->appointment->event->id,
            'selectedAppointmentId' => $booking->appointment->id,
            'isReschedule' => true,
        ]);
    }

    public function changeBooking(string $bookingHash, Appointment $appointment)
    {
        try {
            $bookingId = HashHelper::decrypt($bookingHash);
            $booking = Booking::on()->find($bookingId);
        } catch (Exception $e) {
            return response()->json(array(
                'success' => false,
                'message' => 'Unable to extract booking!',
            ));
        }

        if ($booking->appointment->id === $appointment->id) {
            return response()->json(array(
                'success' => false,
                'message' => 'It is not possible to change the booking to the same booking!',
            ));
        }

        DB::transaction(function() use ($booking, $appointment) {
            $booking->appointment
                ->update(['remaining_spots' => $booking->appointment->remaining_spots - 1]);

            $appointment->update(['remaining_spots' => $appointment->remaining_spots + 1]);

            $booking->update(['appointment_id' => $appointment->id]);
        });

        $result = [
            'success' => true,
            'message' => 'User Has Successfully Changed Their Class To New Time/Date',
        ];

        return response()->json($result);
    }
}
