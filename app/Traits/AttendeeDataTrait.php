<?php

namespace App\Traits;

use App\Models\Booking;
use Illuminate\Support\Facades\Session;

/**
 * Trait AttendeeDataTrait
 * @package App\Traits
 */
trait AttendeeDataTrait
{
    /**
     * @param int $resultsPerPage
     * @return mixed
     */
    private function getAttendeesPaginate(int $resultsPerPage)
    {
        if ( $resultsPerPage != 0 ) {
            $result = $this->getAttendeesData()->paginate($resultsPerPage);
        } else {
            $result = $this->getAttendeesData()->get();
        }

        return $result;
    }

    /**
     * @return mixed
     */
    private function getAttendeesData()
    {
        $byKeyword = Session::get('attendee.byKeyword');
        $byEvent = Session::get('attendee.byEvent', 'select');
        $byDateStart = Session::get('attendee.byDateStart');
        $byDateEnd = Session::get('attendee.byDateEnd');

        return Booking::query()
            ->with(['client', 'appointment', 'succeededPayments'])
            ->groupBy(['bookings.id'])
            ->whereNotIn('bookings.id', function ($query) {
                $query->select('booking_id')->from('blacklists')->whereNotNull('booking_id');
            })

            ->when(!empty($byKeyword), function ($query) use ($byKeyword) {
                $query
                    ->whereIn('bookings.client_id', function ($query) use ($byKeyword) {
                        $query->select('id')
                            ->from('clients')
                            ->where('clients.first_name', 'like', '%' . $byKeyword . '%')
                            ->orWhere('clients.last_name', 'like', '%' . $byKeyword . '%')
                            ->orWhere('clients.phone', 'like', '%' . $byKeyword . '%')
                            ->orWhere('clients.email', 'like', '%' . $byKeyword . '%');
                    });
            })

            ->when($byEvent != 'select', function ($query) use ($byEvent) {
                $query
                    ->whereIn('bookings.appointment_id', function ($query) use ($byEvent) {
                        $query->select('id')
                            ->from('appointments')
                            ->where('event_id', '=', $byEvent);
                    });
            })

            ->when(!empty($byDateStart), function ($query) use ($byDateStart) {
                $query
                    ->whereIn('bookings.appointment_id', function ($query) use ($byDateStart) {
                        $query->select('id')
                            ->from('appointments')
                            ->where('event_date', '>=', $byDateStart);
                    });
            })

            ->when(!empty($byDateEnd), function ($query) use ($byDateEnd) {
                $query
                    ->whereIn('bookings.appointment_id', function ($query) use ($byDateEnd) {
                        $query->select('id')
                            ->from('appointments')
                            ->where('event_date', '<=', $byDateEnd);
                    });
            })

            ->defaultSort('bookings.id', 'asc');
    }
}
