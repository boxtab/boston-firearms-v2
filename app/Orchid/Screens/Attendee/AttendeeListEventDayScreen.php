<?php

namespace App\Orchid\Screens\Attendee;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Event;
use App\Orchid\Layouts\Attendee\AttendeeListExLayout;
use App\Orchid\Layouts\Attendee\AttendeeListLayout;
use App\Orchid\Layouts\Attendee\AttendeeRescheduleLayout;
use App\Traits\AttendeeTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Layout;

class AttendeeListEventDayScreen extends Screen
{
    use AttendeeTrait;

    private const PAGINATE = 10;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var string
     */
    private $day;

    /**
     * Query data.
     *
     * @param Event $event
     * @param string $day
     * @param Request $request
     * @return iterable
     */
    public function query(Event $event, string $day, Request $request): iterable
    {
        $this->event = $event;
        $this->day = $day;

        $attendees = Booking::on()
            ->whereHas('appointment', function ($query) use ($event, $day) {
                return $query->where('appointments.event_id', $event->id)
                    ->where('appointments.event_date', $day);
            })
            ->with(['client', 'appointment', 'payments'])
            ->orderBy('created_at')
            ->paginate(self::PAGINATE);

        return [
            'attendees' => $attendees,
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
        return 'On: ' . $this->day;
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
                ->route('platform.systems.events.appointments', $this->event->id)
                ->icon('folder-alt')
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
            AttendeeListExLayout::class,

            Layout::modal('rescheduleClass', AttendeeRescheduleLayout::class)
                ->async('asyncGetBooking'),
        ];
    }
}
