<?php

namespace App\Orchid\Layouts\Attendee;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class AttendeeRescheduleLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('client')
                ->title('Client')
                ->disabled(),

            Input::make('currentCourse')
                ->title('Current course')
                ->disabled(),

            Input::make('recordingDateTime')
                ->title('Date and time of recording')
                ->disabled(),

            Select::make('eventId')
                ->options($this->query->get('events') ?? [])
                ->title('Pick Course'),

            Select::make('appointmentId')
                ->options($this->query->get('appointments') ?? [])
                ->title('Date & Time'),
        ];
    }
}
