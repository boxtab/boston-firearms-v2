<?php

namespace App\Orchid\Screens\Attendee;

use App\Http\Resources\CalendarAppointmentsListResource;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Event;
use App\Orchid\Layouts\Attendee\AttendeeListExLayout;
use App\Orchid\Layouts\Attendee\AttendeeListLayout;
use App\Orchid\Layouts\Attendee\AttendeeRescheduleLayout;
use App\Services\AppointmentService;
use App\Traits\AttendeeTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use function Clue\StreamFilter\fun;

class AttendeeListAppointmentScreen extends Screen
{
    use AttendeeTrait;

    private const PAGINATE = 10;

    /**
     * @var Event
     */
    private Event $event;

    /**
     * @var Appointment
     */
    private Appointment $appointment;

    /**
     * Query data.
     *
     * @param Event $event
     * @param Appointment $appointment
     * @param Request $request
     * @return array
     */
    public function query(Event $event, Appointment $appointment, Request $request): iterable
    {
        $this->event = $event;
        $this->appointment = $appointment;

        return [
            'attendees' => $appointment->bookings()->with(['client', 'appointment'])->paginate(self::PAGINATE),
            'pageNumber' => $request->get('page', 1),
            'pageCount' => self::PAGINATE,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'List of participants for the event: '. $this->event->title;
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'On: ' . $this->appointment->date_time_formatted;
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Link::make(__('Print Certificate'))
                ->route('certificate.appointment.export', [$this->appointment->id, 'I'])
                ->target('_blank')
                ->icon('briefcase'),

            Link::make(__('Back'))
                ->route('platform.systems.events.appointments', $this->event->id)
                ->icon('folder-alt'),

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
            AttendeeListExLayout::class,

            Layout::modal('rescheduleClass', AttendeeRescheduleLayout::class)
                ->async('asyncGetBooking'),
        ];
    }
}
