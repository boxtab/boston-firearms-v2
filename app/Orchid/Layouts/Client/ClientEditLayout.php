<?php

namespace App\Orchid\Layouts\Client;

use App\Models\Client;
use App\Models\Event;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateRange;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class ClientEditLayout extends Rows
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
        return [
            Input::make('client.first_name')
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('First name'))
            ,

            Input::make('client.last_name')
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('Last name'))
            ,

            Input::make('client.phone')
                ->type('text')
                ->max(64)
                ->required()
                ->horizontal()
                ->title(__('Phone No.'))
            ,

            Input::make('client.email')
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('Email'))
            ,

            DateTimer::make('client.date_of_birth')
                     ->horizontal()
                     ->format('Y-m-d')
                     ->placeholder('Select date')
                     ->title('Date of Birth')
            ,

        ];
    }
}
