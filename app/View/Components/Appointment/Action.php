<?php

namespace App\View\Components\Appointment;

use App\Models\Appointment;
use App\Models\Event;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class Action extends Component
{
    public Appointment $appointment;

    /**
     * Create a new component instance.
     *
     * @param Appointment $appointment
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return DropDown::make()
            ->icon('options-vertical')
            ->list([
                Link::make(__('View list'))
                    ->route('platform.systems.events.appointment.attendees', [
                        'eventId' => $this->appointment->event_id,
                        'appointmentId' => $this->appointment->id,
                    ])
                    ->icon('list')
                ,

                Link::make(__('Edit'))
                    ->route('platform.systems.events.appointment.edit', [
                        'eventId' => $this->appointment->event_id,
                        'appointmentId' => $this->appointment->id,
                    ])
                    ->icon('note')
                ,

                Button::make(__('Delete'))
                    ->icon('trash')
                    ->method('removeAppointment', [
                        'appointmentId' => $this->appointment->id,
                    ])
                    ->confirm(__('Do You Want To Delete Class?'))
                ,
            ]);
    }
}
