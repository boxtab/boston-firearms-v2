<?php

namespace App\Orchid\Layouts\Event;

use App\Models\Event;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;


class EventListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'events';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('S.No.')
                ->render(function (Event $event) {
                    return $event->id . '.';
                }),

            TD::make('title', 'Name')
                ->filter(Input::make())
                ->render(function (Event $event) {
                    return Link::make($event->title)
                        ->route('platform.systems.events.edit', $event->id)
                        ->class('cc-name-btn');
                }),

            TD::make('course_certification_number', 'Certification number')
                ->render(function (Event $event) {
                    return $event->course_certification_number;
                }),

            TD::make('Event Days')
                ->render(function (Event $event) {
                    return Link::make('')
                        ->route('platform.systems.events.appointment.create', $event->id)
                        ->icon('calendar')
                        ->class('cc-calendar-btn')
                        .
                        Link::make('')
                        ->route('platform.systems.events.appointments', $event->id)
                        ->icon('list')
                        ->class('cc-list-btn');
                }),

            TD::make('Price ($)')
                ->render(function (Event $event) {
                    return $event->price_format;
                }),

            TD::make('Attendees')
                ->render(function (Event $event) {
                    return $event->getAttendeesCount();
                }),

            TD::make('Visibility')
                ->render(function (Event $event) {
                    return $event->active_format;
                }),

            TD::make(__('Delete'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Event $event) {
                    // return Button::make(__('Delete'))
                    return Button::make(__(''))
                        ->icon('trash')
                        ->confirm(__('Are you sure you want to delete the event?'))
                        ->method('remove', [
                            'eventId' => $event->id,
                        ]);
                }),
        ];
    }
}
