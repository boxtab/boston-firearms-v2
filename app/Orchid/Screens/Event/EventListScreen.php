<?php

namespace App\Orchid\Screens\Event;

use App\Models\Event;
use App\Orchid\Layouts\Event\EventListLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class EventListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'events' => Event::filters()->defaultSort('id', 'asc')->paginate(50),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        $eventCount = Event::count();
        return "Event($eventCount)";
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All events';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'event.create',
            'event.edit',
            'event.show',
            'event.delete',
            'event.access',
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
                ->href(route('platform.systems.events.create')),
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
            EventListLayout::class,
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        Event::on()->findOrFail($request->get('eventId'))->delete();

        Toast::info(__('Event was removed'));
    }
}
