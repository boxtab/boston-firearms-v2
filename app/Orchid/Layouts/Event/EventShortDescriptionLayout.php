<?php

namespace App\Orchid\Layouts\Event;

use Illuminate\Support\Facades\Log;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Rows;

class EventShortDescriptionLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        $bar = $this->query->get('event.short_description');

        return [
            Quill::make('event.short_description')
                ->toolbar(["text", "color", "header", "list", "format", "media"]),
        ];
    }
}
