<?php

namespace App\View\Components\Appointment;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;

class AddClass extends Component
{
    /**
     * @var int
     */
    public $eventId;

    /**
     * @var string
     */
    public $eventDate;

    /**
     * Create a new component instance.
     *
     * @param int $eventId
     * @param string $eventDate
     */
    public function __construct(int $eventId, string $eventDate)
    {
        $this->eventId = $eventId;
        $this->eventDate = $eventDate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return Button::make(__('Add class'))
            ->method('addClass', [
                'eventId' => $this->eventId,
                'eventDate' => $this->eventDate,
            ]);
    }
}
