<?php

namespace App\Orchid\Layouts\Attendee;

use App\Helpers\PaymentHelper;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AttendeeListExLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'attendees';

    private $rank;

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        $this->rank = $this->query->get('initialRank');

        return [
            TD::make('rank', 'S.No.')
                ->render(function () {
                    return ++$this->rank;
                })
            ,

            TD::make('name', 'Name')
                ->render(function(Booking $booking) {
                    return Link::make($booking->client->full_name_format)
                        ->route('platform.systems.clients.edit', $booking->client_id);
                })
            ,

            TD::make('email', 'Email')
                ->render(function(Booking $booking) {
                    return $booking->client->email;
                })
            ,

            TD::make('phone', 'Phone')
                ->render(function(Booking $booking) {
                    return $booking->client->phone;
                })
            ,

            TD::make('when', 'When')
                ->render(function(Booking $booking) {
                    return Link::make($booking->appointment->date_time_lesson)
                        ->route('platform.systems.events.appointment.edit', [$booking->appointment->event_id, $booking->appointment_id]);
                })
            ,

            TD::make('live_fire', 'Live Fire')
                ->render(function(Booking $booking) {
                    return $booking->appointment->live_fire_format == 1 ? 'Yes' : 'No';
                })
            ,

            TD::make('payment', 'Payment Info')
              ->render(function(Booking $booking) {
                  return $booking->payments_info ? : 'Not found';
              })
            ,

            TD::make('visited', 'Visited')
                ->render(function(Booking $attendee) {
                    return Button::make(__($attendee->visited_text))
                        ->method('setVisited', [
                            'attendeeId' => $attendee->id,
                        ])
                        ->icon('monitor');
                })
            ,

            TD::make('is_waiver', 'Waiver')
                ->render(function(Booking $booking) {
                    return $booking->waiver_text;
                })
            ,

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Booking $booking) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Print Certificate'))
                                ->route('certificate.booking.export', [$booking->id, 'I'])
                                ->target('_blank')
                                ->icon('briefcase'),

                            Button::make(__('Blacklist'))
                                ->method('addBlacklist', [
                                    'attendeeId' => $booking->id,
                                ])
                                ->icon('note')
                                ->confirm(__('Do You want to Add ' . $booking->client->full_name_format . ' To Blacklist?')),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('removeAttendee', [
                                    'attendeeId' => $booking->id,
                                ])
                                ->confirm(__('Do You Want To Delete Attendee?')),

                            ModalToggle::make('Reschedule a class')
                                ->modal('rescheduleClass')
                                ->modalTitle('Reschedule a Class')
                                ->method('rescheduleClass')
                                ->asyncParameters([
                                    'bookingId' => $booking->id
                                ])
                                ->icon('docs'),
                        ]);
                })
            ,
        ];
    }
}
