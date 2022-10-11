<?php

namespace App\Traits;

use App\Models\Blacklist;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/**
 * Trait AttendeeBlacklistDataTrait
 * @package App\Traits
 */
trait AttendeeBlacklistDataTrait
{
    /**
     * @param int $resultsPerPage
     * @return mixed
     */
    private function getBlacklistsPaginate(int $resultsPerPage)
    {
        if ( $resultsPerPage != 0 ) {
            $result = $this->getBlacklistsData()->paginate($resultsPerPage);
        } else {
            $result = $this->getBlacklistsData()->get();
        }

        return $result;
    }

    /**
     * @return mixed
     */
    private function getBlacklistsData()
    {
        $byKeyword = Session::get('attendee-blacklist.byKeyword');
        $byEvent = Session::get('attendee-blacklist.byEvent', 'select');
        $byDateStart = Session::get('attendee-blacklist.byDateStart');
        $byDateEnd = Session::get('attendee-blacklist.byDateEnd');

        return Blacklist::on()
            ->filters()
            ->when(!empty($byKeyword), function ($query) use ($byKeyword) {
                $query
                    ->whereIn('blacklists.booking_id', function ($query) use ($byKeyword) {
                        $query->select('bookings.id')
                            ->from('bookings')
                            ->leftJoin('clients', 'bookings.client_id', '=', 'clients.id')
                            ->where('clients.first_name', 'like', '%' . $byKeyword . '%')
                            ->orWhere('clients.last_name', 'like', '%' . $byKeyword . '%')
                            ->orWhere('clients.phone', 'like', '%' . $byKeyword . '%')
                            ->orWhere('clients.email', 'like', '%' . $byKeyword . '%')
                            ->groupBy('bookings.id');
                    });
            })
            ->when($byEvent != 'select', function ($query) use ($byEvent) {
                $query
                    ->whereIn('blacklists.booking_id', function ($query) use ($byEvent) {
                        $query->select('bookings.id')
                            ->from('bookings')
                            ->leftJoin('appointments', 'bookings.appointment_id', '=', 'appointments.id')
                            ->leftJoin('events', 'appointments.event_id', '=', 'events.id')
                            ->where('events.id', '=', $byEvent)
                            ->groupBy('bookings.id');
                    });
            })

            ->when(!empty($byDateStart), function ($query) use ($byDateStart) {
                $query
                    ->whereIn('blacklists.booking_id', function ($query) use ($byDateStart) {
                        $query->select('bookings.id')
                            ->from('bookings')
                            ->leftJoin('appointments', 'bookings.appointment_id', '=', 'appointments.id')
                            ->where('appointments.event_date', '>=', $byDateStart)
                            ->groupBy('bookings.id');
                    });
            })

            ->when(!empty($byDateEnd), function ($query) use ($byDateEnd) {
                $query
                    ->whereIn('blacklists.booking_id', function ($query) use ($byDateEnd) {
                        $query->select('bookings.id')
                            ->from('bookings')
                            ->leftJoin('appointments', 'bookings.appointment_id', '=', 'appointments.id')
                            ->where('appointments.event_date', '<=', $byDateEnd)
                            ->groupBy('bookings.id');
                    });
            })

            ->defaultSort('blacklists.id', 'asc');
    }
}
