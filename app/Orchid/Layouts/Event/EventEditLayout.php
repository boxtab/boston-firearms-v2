<?php

namespace App\Orchid\Layouts\Event;

use App\Constants\ResultPerPageConstant;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layout;

class EventEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('event.title')
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('Title'))
            ,

            Input::make('event.price')
                ->type('number')
                ->mask([
                    'alias' => 'currency',
                    'prefix' => ' ',
                    'groupSeparator' => ' ',
                    'digitsOptional' => true,
                ])
                ->required()
                ->min('0.00')
                ->step('0.01')
                ->horizontal()
                ->title(__('Price'))
                ->help(__('In US Dollar'))
            ,

            Input::make('event.slug')
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('URL slug'))
            ,

            RadioButtons::make('event.radiobutton_has_live_fire')
                ->options([
                    2 => 'Active',
                    1 => 'Inactive',
                ])
                ->required()
                ->horizontal()
                ->title('Live fire')
            ,

            RadioButtons::make('event.radiobutton_active')
                ->options([
                    2 => 'Active',
                    1 => 'Inactive',
                ])
                ->required()
                ->horizontal()
                ->title('Activate contact form')
            ,

            Input::make('event.course_certification_number')
                ->type('text')
                ->max(255)
                ->horizontal()
                ->title(__('Course certification number'))
            ,
        ];
    }
}
