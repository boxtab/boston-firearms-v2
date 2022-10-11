<?php

namespace App\Orchid\Screens\Event;

use App\Http\Requests\EventSaveRequest;
use App\Models\Event;
use App\Orchid\Layouts\Event\EventDescriptionLayout;
use App\Orchid\Layouts\Event\EventEditLayout;
use App\Orchid\Layouts\Event\EventFaqsLayout;
use App\Orchid\Layouts\Event\EventShortDescriptionLayout;
use App\Orchid\Layouts\Event\EventWhoForLayout;
use App\Repositories\EventRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

/**
 * Class EventEditScreen
 * @package App\Orchid\Screens\Event
 */
class EventEditScreen extends Screen
{
    /**
     * @var Event
     */
    public $event;

    /**
     * @var EventRepositoryInterface
     */
    private $eventRepository;

    /**
     * EventEditScreen constructor.
     * @param EventRepositoryInterface $eventRepository
     */
    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Query data.
     *
     * @param Event $event
     *
     * @return iterable
     */
    public function query(Event $event): iterable
    {
        return [
            'event' => $event,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Manage event';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return $this->event->exists ? 'Edit Event' : 'Create Event';
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
            Button::make(__('Cancel'))
                ->icon('close')
                ->novalidate()
                ->method('cancel'),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
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
            Layout::block([
                EventEditLayout::class,
            ])
                ->title('Event information')
                ->description('Basic information about the event.')
                ->vertical(true),

            Layout::block([
                EventWhoForLayout::class
            ])
                ->title('Who Is This Class For?')
                ->vertical(true),

            Layout::block([
                EventShortDescriptionLayout::class,
            ])
                ->title('Brief description')
                ->vertical(true),

            Layout::block([
                EventDescriptionLayout::class,
            ])
                ->title('Description')
                ->vertical(true),

            Layout::block([
                EventFaqsLayout::class
            ])
                ->title('Event FAQs')
                ->vertical(true),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel()
    {
        return redirect()->route('platform.systems.events');
    }

    /**
     * @param Event $event
     * @param EventSaveRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Event $event, EventSaveRequest $request)
    {
        $eventFields = $request->get('event');
        $this->eventRepository->store($event, $eventFields);

        Toast::info(__('Event was saved'));
        return redirect()->route('platform.systems.events');
    }
}
