<?php

namespace App\Orchid\Layouts\InfoSource;

use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class InfoSourceEditLayout extends Rows
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
            Group::make([
                Input::make('info-source.title')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->horizontal()
                    ->title(__('Info source')),

                Button::make('Create')
                    ->method('buttonCreate')
                    ->type(Color::PRIMARY()),
            ]),
        ];
    }
}
