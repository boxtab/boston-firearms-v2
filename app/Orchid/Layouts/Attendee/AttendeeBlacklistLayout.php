<?php

namespace App\Orchid\Layouts\Attendee;

use App\Models\Blacklist;
use App\Models\Client;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AttendeeBlacklistLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'blacklists';

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
                }),

            TD::make('full_name', 'Full Name')
                ->render(function (Blacklist $blacklist) {
                    return  is_null($blacklist->booking_id) ? null : $blacklist->booking->client->full_name_format;
                }),

            TD::make('reason', 'Reason'),

            TD::make('event_date', 'Date')
                ->render(function (Blacklist $blacklist) {
                    return is_null($blacklist->booking_id) ? null : $blacklist->booking->appointment->date_time_lesson;
                }),

            TD::make('phone', 'Phone No.')
                ->render(function (Blacklist $blacklist) {
                    return is_null($blacklist->booking_id) ? null : $blacklist->booking->client->phone;
                }),

            TD::make('email', 'Email Id')
                ->render(function (Blacklist $blacklist) {
                    return is_null($blacklist->booking_id) ? null : $blacklist->booking->client->email;
                }),

            TD::make(__('Remove'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Blacklist $blacklist) {
                    return Button::make(__('Remove'))
                        ->icon('trash')
                        ->confirm('Remove client ' . (is_null($blacklist->booking_id) ? null : $blacklist->booking->client->full_name_format) . ' from blacklist?')
                        ->method('removeBlacklist', [
                            'blacklistId' => $blacklist->id,
                        ]);
                }),
        ];
    }
}
