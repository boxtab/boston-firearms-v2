<?php

namespace App\Orchid\Screens\Appointment;

use App\Helpers\AppointmentHelper;
use App\Models\Appointment;
use App\Models\Event;
use App\Orchid\Layouts\Appointment\AppointmentPerEventLayout;
use App\Traits\QueryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Sight;
use Orchid\Screen\Fields\Input;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Orchid\Screen\Repository;

class AppointmentListScreen extends Screen
{
    //use QueryTrait;

    private const PAGINATE = 10;

    /**
     * @var Event
     */
    private $event;

    /**
     * Query data.
     *
     * @param Event $event
     *
     * @return iterable
     */
    public function query(Event $event): iterable
    {
        $this->event = $event;
        $appointments = Appointment::query()
                                   ->withCount('bookings')
                                   ->with('sessions')
                                   ->where('appointments.event_id', '=', $event->id)
                                   ->groupBy('appointments.event_date')
                                   ->orderBy('appointments.event_date')
                                   ->selectRaw('count(appointments.event_date) as eventDateCount')
                                   ->paginate(self::PAGINATE);
        return [
            'appointments' => $appointments
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Appointment List: ' . $this->event->title;
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Days Management';
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
            Link::make(__('Create'))
                ->icon('plus')
                ->route('platform.systems.events.appointment.create', $this->event->id),

            Button::make(__('Back'))
                ->icon('folder-alt')
                ->novalidate()
                ->method('back'),
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
            AppointmentPerEventLayout::class,
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function back()
    {
        return redirect()->route('platform.systems.events');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAppointment(Request $request)
    {
        $appointmentId = $request->get('appointmentId');
        $eventId = Appointment::find($appointmentId)->event_id;

        Appointment::findOrFail($appointmentId)->delete();

        Toast::info(__('Appointment was removed'));
        return redirect()->route('platform.systems.events.appointments', $eventId);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAppointmentPerDay(Request $request)
    {
        $eventId = $request->get('eventId');
        $eventDate = $request->get('eventDate');

        Appointment::on()
            ->where('event_id', '=', $eventId)
            ->where('event_date', '=', $eventDate)
            ->delete();

        Toast::info(__('Appointment per day was removed'));
        return redirect()->route('platform.systems.events.appointments', $eventId);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addClass(Request $request)
    {
        $eventId = $request->get('eventId');
        $eventDate = $request->get('eventDate');

        Session::put('createAppointment.dateRange', $eventDate);

        return redirect()->route('platform.systems.events.appointment.create', $eventId);
    }
}
