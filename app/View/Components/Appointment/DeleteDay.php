<?php

namespace App\View\Components\Appointment;

use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;
use Orchid\Screen\Actions\Button;

class DeleteDay extends Component
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
        $eventDateFormat = date('m/d/Y', strtotime($this->eventDate));

        return Button::make(__('Delete'))
            ->icon('trash')
            ->method('removeAppointmentPerDay', [
                'eventId' => $this->eventId,
                'eventDate' => $this->eventDate,
            ])
            ->confirm(__("Do You Want To Delete All Classes For Date $eventDateFormat?"));
    }
}
