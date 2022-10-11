<?php

namespace App\Orchid\Screens\AttendeeBlacklist;

use App\Constants\ResultPerPageConstant;
use App\Http\Requests\AttendeeSearchRequest;
use App\Models\Blacklist;
use App\Orchid\Layouts\Attendee\AttendeeBlacklistLayout;
use App\Orchid\Layouts\Attendee\AttendeeSearchLayout;
use App\Traits\AttendeeBlacklistDataTrait;
use App\Traits\AttendeeBlackListTrait;
use App\Traits\AttendeeSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

/**
 * Class AttendeeBlacklistScreen
 * @package App\Orchid\Screens\AttendeeBlacklist
 */
class AttendeeBlacklistScreen extends Screen
{
    use AttendeeBlacklistDataTrait;
    use AttendeeSearch;
    use AttendeeBlackListTrait;

    /**
     * Query data.
     *
     * @param Request $request
     * @return array
     */
    public function query(Request $request): iterable
    {
        if ( ! $this->isAnotherPage('admin/attendee-blacklist') ) {
            session()->forget('attendee-blacklist');
        }

        $resultsPerPage = Session::get('attendee-blacklist.resultsPerPage', ResultPerPageConstant::getFirstPagination());

        return [
            'blacklists' => $this->getBlacklistsPaginate($resultsPerPage),
            'initialRank' => ($request->get('page', 1) - 1) * $resultsPerPage,
            'page' => 'attendee-blacklist',
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Attendee Blacklist';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All attendees blacklist';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Reset'))
                ->icon('trash')
                ->novalidate()
                ->method('reset', ['page' => 'attendee-blacklist']),
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
            AttendeeBlacklistLayout::class,
        ];
    }
}
