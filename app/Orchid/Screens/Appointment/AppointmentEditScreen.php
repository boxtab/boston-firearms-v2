<?php

namespace App\Orchid\Screens\Appointment;

use App\Helpers\AppointmentHelper;
use App\Http\Requests\AppointmentOneSaveRequest;
use App\Models\Appointment;
use App\Models\Event;
use App\Orchid\Layouts\Appointment\AppointmentEditLayout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class AppointmentEditScreen extends Screen
{
    /**
     * @var Event
     */
    private $event;

    /**
     * @var Appointment
     */
    private $appointment;

    /**
     * Query data.
     *
     * @param Event $event
     * @param Appointment $appointment
     *
     * @return iterable
     */
    public function query(Event $event, Appointment $appointment): iterable
    {
        $this->event = $event;
        $this->appointment = $appointment;

        return [
            'appointment' => $this->appointment,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit appointment';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return $this->appointment->event->title;
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'appointment.create',
            'appointment.edit',
            'appointment.show',
            'appointment.delete',
            'appointment.access',
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Back'))
                ->route('platform.systems.events.appointments', $this->appointment->event_id)
                ->icon('folder-alt')
            ,

            Button::make(__('Update'))
                ->icon('check')
                ->method('update')
            ,
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            AppointmentEditLayout::class,
        ];
    }

    /**
     * @param Event $event
     * @param Appointment $appointment
     * @param AppointmentOneSaveRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Event $event, Appointment $appointment, AppointmentOneSaveRequest $request)
    {
        $appointmentField = $request->get('appointment');

        $appointment->update([
            'event_date'        => $appointmentField['event_date'],
            'start_time'        => $appointmentField['event_date'] . ' ' . date("H:i", strtotime($appointmentField['start_time'])) . ':00',
            'end_time'          => $appointmentField['event_date'] . ' ' . date("H:i", strtotime($appointmentField['end_time'])) . ':00',
            'spots'             => $appointmentField['spots'],
            'remaining_spots'   => $appointmentField['remaining_spots'],
            'registration_fee'  => $appointmentField['registration_fee'],
            'deposit_fee'       => $appointmentField['deposit_fee'],
            'payment_type'      => $appointmentField['payment_type'],
            'has_live_fire'     => $appointmentField['radiobutton_has_live_fire'] - 1,
            'added_by'          => Auth::id(),
        ]);

        Toast::info(__('Appointment was updated'));
        return redirect()->route('platform.systems.events.appointments', $event->id);
    }
}
