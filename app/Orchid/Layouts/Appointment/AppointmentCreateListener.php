<?php

namespace App\Orchid\Layouts\Appointment;

use Illuminate\Support\Facades\Log;
use Orchid\Screen\Fields\DateRange;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Listener;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\Session;

/**
 * Class AppointmentCreateListener
 * @package App\Orchid\Layouts\Appointment
 */
class AppointmentCreateListener extends Listener
{
    /**
     * @return \Orchid\Support\Facades\Layout[]
     */
    protected function layouts(): iterable
    {
        $dateRange = null;
        if (Session::has('createAppointment.dateRange')) {
            $dateRange = [
                'start' => Session::get('createAppointment.dateRange'),
                'end' => Session::get('createAppointment.dateRange'),
            ];
            Session::forget('createAppointment');
        }


        return [
            Layout::rows([
                Group::make([
                    DateRange::make('select_date')
                        ->autocomplete(false)
                        ->value($dateRange)
                        ->title('Select date range')
                        ,
                ])->autoWidth(),
            ]),

            Layout::view('platform::firearms.appointment.layout'),
        ];
    }
}
