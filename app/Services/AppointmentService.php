<?php


namespace App\Services;


use App\Models\Appointment;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Traits\Conditionable;

class AppointmentService {

    /**
     * @param Event $event
     * @param null $month Pass 'Y-m-d' to define month to select appointments
     *
     * @return mixed
     */
    public function getListByEventQuery(Event $event, $month = null): mixed
    {
        return Appointment::query()
                          ->where( 'event_id', '=', $event->id )
                          ->where( 'event_date', '>=', now() )
                          ->where('remaining_spots', '>', 0)
                          ->when( ! is_null( $month ), function ( $query ) use ( $month ) {
                              return $query->whereBetween( 'start_time', [
                                  Carbon::make( $month )->firstOfMonth(),
                                  Carbon::make( $month )->lastOfMonth()
                              ] );
                          } )
                          ->orderBy( 'event_date', 'asc' )
                          ->orderBy( 'start_time', 'asc' )
                          ->orderBy( 'end_time', 'asc' );
    }
}
