<?php

namespace App\Traits;

use App\Actions\RescheduleAction;
use App\Models\Appointment;
use App\Models\Blacklist;
use App\Models\Booking;
use App\Models\Event;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Orchid\Support\Facades\Toast;

/**
 * Trait AttendeeTrait
 * @package App\Traits
 */
trait AttendeeTrait
{
    /**
     * @param int $bookingId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addBlacklist(int $bookingId)
    {
        $blacklist = Blacklist::on()->where('booking_id', '=', $bookingId)->first();
        if ( ! is_null($blacklist) ) {
            Toast::error(__('The client is already blocked!'));
            return redirect()->back();
        }

        return redirect()->route('platform.systems.attendee.blacklist', $bookingId);
    }

    /**
     * @param Request $request
     */
    public function removeAttendee(Request $request): void
    {
        Booking::on()->findOrFail($request->get('attendeeId'))->delete();

        Toast::info(__('Attendee was removed.'));
    }

    /**
     * @param Request $request
     */
    public function setVisited(Request $request)
    {
        $booking = Booking::on()->find($request->get('attendeeId'));

        $booking->update([
            'visited' => ( ! $booking->visited ),
        ]);
    }

    /**
     * @param Booking $booking
     *
     * @return array
     */
    public function asyncGetBooking(Booking $booking): iterable
    {
        $appointments = (new AppointmentService())->getListByEventQuery( $booking->appointment->event )
        ->get()
        ->mapWithKeys(function ($appointment) {
            return [$appointment->id => $appointment->date_time_formatted];
        })
        ->toArray();

        return [
            'client' => $booking->client->full_name_format,
            'currentCourse' => $booking->appointment->event->title,
            'recordingDateTime' => $booking->appointment->date_time_lesson,

            'events' => Event::on()
                ->active()
                ->hasAppointments()
                ->orderBy('id')
                ->get()
                ->mapWithKeys(function ($event) {
                    return [$event->id => $event->title];
                })
                ->toArray(),



            'appointments' => $appointments,
        ];
    }

    /**
     * @param Request $request
     */
    public function rescheduleClass(Request $request): void
    {
        $booking = Booking::where('id', $request->get('bookingId'))->firstOrFail();
        $appointment = Appointment::where('id', $request->get('appointmentId'))->firstOrFail();

        if ( $appointment->isPast() ) {
            Toast::error(__('The meeting has already passed!'));
            return;
        }

        if ( ! $booking->isPaid() ) {
            Toast::error(__('The lesson is not paid!'));
            return;
        }

        (new RescheduleAction())->handle($booking, $appointment);

        Toast::info(__('The client has been moved to another class.'));
    }
}
