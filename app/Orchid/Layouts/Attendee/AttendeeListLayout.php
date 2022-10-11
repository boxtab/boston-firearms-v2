<?php

namespace App\Orchid\Layouts\Attendee;

use App\Constants\PaymentConstants;
use App\Helpers\PaymentHelper;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AttendeeListLayout extends Table
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
        $pageNumber = $this->query->get('pageNumber');
        $pageCount = $this->query->get('pageCount');
        $this->rank = ($pageNumber - 1) * $pageCount;

        return [
            TD::make('rank', 'S.No.')
                ->render(function () {
                    return ++$this->rank;
                })
            ,

//            TD::make('id', 'ID')
//                ->render(function (Booking $attendees) {
//                    return $attendees->booking_id;
//                })
//            ,

            TD::make('name', 'Name')
                ->render(function(Booking $attendees) {
                    return Link::make($attendees->client_first_name . ' ' . $attendees->client_last_name)
                        ->route('platform.systems.clients.edit', $attendees->client_id);
                })
            ,

            TD::make('email', 'Email')
                ->render(function(Booking $attendees) {
                    return $attendees->client_email;
                })
            ,

            TD::make('phone', 'Phone')
                ->render(function(Booking $attendees) {
                    return $attendees->client_phone;
                })
            ,

            TD::make('when', 'When')
                ->render(function(Booking $attendees) {
                    $dateTimeLesson = date('m-d-Y', strtotime($attendees->appointment_event_date))
                        . ' '
                        . date('h:i A', strtotime($attendees->appointment_start_time));

                    return Link::make($dateTimeLesson)
                        ->route('platform.systems.events.appointment.edit', [$attendees->appointment_event_id, $attendees->booking_appointment_id]);
                })
            ,

            TD::make('live_fire', 'Live Fire')
                ->render(function(Booking $attendees) {
                    return $attendees->appointment_has_live_fire == 1 ? 'Yes' : 'No';
                })
            ,

            TD::make('payment', 'Payment Option/Mode')
                ->render(function(Booking $attendees) {
                    return PaymentHelper::getTypeText($attendees->payment_type) . '/' . PaymentHelper::getGatewayText($attendees->payment_gateway);
                })
            ,

            TD::make('visited', 'Visited')
                ->render(function(Booking $attendee) {
                    $visitedText = ($attendee->booking_visited == 1) ? 'Visited' : 'Not visited';
                    return Button::make(__($visitedText))
                        ->method('setVisited', [
                            'attendeeId' => $attendee->booking_id,
                        ])
                        ->icon('monitor');
                })
            ,

            TD::make('is_waiver', 'Waiver')
                ->render(function(Booking $attendees) {
                    return $attendees->booking_is_waiver == 1 ? 'Yes' : 'No';
                })
            ,

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Booking $attendee) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Certificate printing'))
                                ->route('certificate.booking.export', [$attendee->booking_id, 'I'])
                                ->target('_blank')
                                ->icon('briefcase'),

                            Button::make(__('Blacklist'))
                                ->method('addBlacklist', [
                                    'attendeeId' => $attendee->booking_id,
                                ])
                                ->icon('note')
                                ->confirm(__('Do You want to Add ' . $attendee->client_first_name . ' ' . $attendee->client_last_name . ' To Blacklist?')),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('removeAttendee', [
                                    'attendeeId' => $attendee->booking_id,
                                ])
                                ->confirm(__('Do You Want To Delete Attendee?')),
                        ]);
                })
            ,

        ];
    }
}
