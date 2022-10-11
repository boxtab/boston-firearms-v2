<?php

namespace App\Orchid\Screens\Attendee;

use App\Http\Requests\BlacklistSaveRequest;
use App\Models\Blacklist;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BlacklistScreen extends Screen
{
    /**
     * Query data.
     *
     * @param Booking $booking
     *
     * @return iterable
     */
    public function query(Booking $booking): iterable
    {
        return [
            'booking' => $booking,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Blacklist';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Add to blacklist';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'client.create',
            'client.edit',
            'client.show',
            'client.delete',
            'client.access',
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
            Button::make(__('Cancel'))
                ->icon('close')
                ->novalidate()
                ->method('cancel'),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
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
            Layout::legend('booking', [
                Sight::make('fullName', 'Full name')->render(function (Booking $booking) {
                    return $booking->client->full_name_format;
                }),
            ]),

            Layout::rows([
                Input::make('blacklist.reason')
                    ->type('text')
                    ->max(255)
                    ->horizontal()
                    ->required()
                    ->title(__('Reason')),
                    ]
            ),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel()
    {
        return redirect()->route('platform.systems.attendee');
    }

    /**
     * @param Booking $attendee
     * @param BlacklistSaveRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Booking $attendee, BlacklistSaveRequest $request)
    {
        Blacklist::create([
            'booking_id' => $attendee->id,
            'reason' => $request->get('blacklist')['reason'],
            'added_by' => Auth::id(),
        ]);

        Toast::info(__('The client has been blacklisted.'));

        return redirect()->route('platform.systems.attendee');
    }
}
