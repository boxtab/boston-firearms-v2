<?php

namespace App\Orchid\Layouts\Appointment;

use App\Models\Appointment;
use App\Models\Booking;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Repository;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class AppointmentPerEventLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'appointments';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('data')->render(function (Appointment $model) {
                $sessions = [];
                $numberBooked = 0;
                if ($model->eventDateCount > 1 ) {
                    $numberBooked = Booking::whereHas('appointment', function ($query) use ($model){
                        return $query->where('appointments.event_id', $model->event_id)->where('appointments.event_date', $model->event_date);
                    })->count();
                    $sessions = $model->sessions()->withCount('bookings')->get();
                } else {
                    $sessions[] = $model;
                    $numberBooked = $model->bookings_count;
                }
                return view('admin-panel.appointments.appointment-day', [
                    'eventId' => $model->event_id,
                    'date' => $model->event_date->format('Y-m-d'),
                    'numberBooked' => $numberBooked,
                    'sessions' => $sessions,
                ]);
            }),
        ];
    }
}
