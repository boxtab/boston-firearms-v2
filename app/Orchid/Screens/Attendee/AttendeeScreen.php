<?php

namespace App\Orchid\Screens\Attendee;

use App\Constants\ResultPerPageConstant;
use App\Orchid\Layouts\Attendee\AttendeeListExLayout;
use App\Orchid\Layouts\Attendee\AttendeeRescheduleLayout;
use App\Orchid\Layouts\Attendee\AttendeeSearchLayout;
use App\Traits\AttendeeSearch;
use App\Traits\AttendeeDataTrait;
use App\Traits\AttendeeTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

/**
 * Class AttendeeScreen
 * @package App\Orchid\Screens\Attendee
 */
class AttendeeScreen extends Screen
{
    use AttendeeDataTrait;
    use AttendeeTrait;
    use AttendeeSearch;

    /**
     * Query data.
     *
     * @param Request $request
     * @return array
     */
    public function query(Request $request): iterable
    {
        if ( ! $this->isAnotherPage('admin/attendee') ) {
            session()->forget('attendee');
        }

        $resultsPerPage = Session::get('attendee.resultsPerPage', ResultPerPageConstant::getFirstPagination());

        return [
            'attendees' => $this->getAttendeesPaginate($resultsPerPage),
            'initialRank' => ($request->get('page', 1) - 1) * $resultsPerPage,
            'page' => 'attendee',
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Attendees';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All attendees';
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
            Link::make(__('Add'))
                ->icon('plus')
                ->href(route('platform.systems.clients.create')),

            Button::make(__('Reset'))
                ->icon('trash')
                ->novalidate()
                ->method('reset', ['page' => 'attendee']),
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
            AttendeeSearchLayout::class,
            AttendeeListExLayout::class,
            Layout::modal('rescheduleClass', AttendeeRescheduleLayout::class)
                ->async('asyncGetBooking')
        ];
    }
}
