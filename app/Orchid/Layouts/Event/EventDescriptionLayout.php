<?php

namespace App\Orchid\Layouts\Event;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Rows;

class EventDescriptionLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Quill::make('event.description')
                ->toolbar(["text", "color", "header", "list", "format", "media"]),

//            SimpleMDE::make('event.description')
        ];
    }
}
