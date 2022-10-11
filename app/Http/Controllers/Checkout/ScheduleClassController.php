<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Requests\Checkout\CheckoutScheduleRequest;
use App\Http\Resources\CalendarAppointmentsListResource;
use App\Models\Appointment;
use App\Models\Event;
use App\Services\AppointmentService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class ScheduleClassController
 * @package App\Http\Controllers
 */
class ScheduleClassController extends Controller
{
    use CheckoutTrait;

    /**
     * @param Event|null $event
     * @param AppointmentService $appointmentService
     *
     * @return Factory|View
     */
    public function show(?Event $event, AppointmentService $appointmentService)
    {
        $appointment = null;
        if (is_null($event->id)) {
            $this->clearBookingSession();
        }
        $checkoutSession = $this->getBookingSession();
        if ( isset( $checkoutSession['appointment_id'] ) ) {
            $appointment = Appointment::find($checkoutSession['appointment_id']);
            if ( is_null($appointment) || $appointment->event->id != $event->id ) {
                $this->clearBookingSession();
            }
        }

        return view('pages.checkout.schedule-class', [
                'event_id' => $event->id,
                'appointment' => $appointment,
                'events' => Event::active()->hasAppointments()->orderBy('id')->get(['id', 'title']),
                'appointments' => CalendarAppointmentsListResource::collection( $appointmentService->getListByEventQuery($event)->get() )
        ]);
    }

    public function store(CheckoutScheduleRequest $request)
    {
        $this->updateBookingSession($request);

        return redirect( route( 'checkout.enter-details.show', [ $request->booking['appointment_id'] ] ) );
    }
}
