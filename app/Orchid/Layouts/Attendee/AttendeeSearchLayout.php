<?php

namespace App\Orchid\Layouts\Attendee;

use App\Constants\ResultPerPageConstant;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class AttendeeSearchLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        $page = $this->query->get('page');

        return [
            Input::make('search_attendee.by_keyword')
                ->type('text')
                ->max(255)
                ->horizontal()
                ->value(Session::get("$page.byKeyword"))
                ->title(__('Keyword')),

            Select::make('search_attendee.by_event')
                ->fromModel(Event::class, 'title')
                ->empty('Select', 'select')
                ->horizontal()
                ->value((int)Session::get("$page.byEvent", 0))
                ->title(__('Event')),

            Select::make('search_attendee.results_per_page')
                ->options(ResultPerPageConstant::ATTENDEES)
                ->horizontal()
                ->value((int)Session::get("$page.resultsPerPage", ResultPerPageConstant::getFirstPagination()))
                ->title(__('Results Per Page')),

            Group::make([
                DateTimer::make('search_attendee.by_date_start')
                    ->format('Y-m-d')
                    ->horizontal()
                    ->title('Date')
                    ->value(Session::get("$page.byDateStart"))
                    ->allowInput(),

                DateTimer::make('search_attendee.by_date_end')
                    ->format('Y-m-d')
                    ->horizontal()
                    ->value(Session::get("$page.byDateEnd"))
                    ->allowInput(),
            ]),

            Button::make('Search')
                ->method('search', ['page' => $page])
                ->type(Color::PRIMARY()),

        ];
    }
}
