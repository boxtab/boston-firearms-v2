<?php

namespace App\Models\Traits\Scope;

/**
 * Trait EventScope
 * @package App\Models\Traits\Scope
 */
trait EventScope
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', '=', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeHasAppointments($query)
    {
        return $query->join('appointments', function ($join){
            $join->on('appointments.event_id', '=', 'events.id')
                ->where('appointments.event_date', '>=', now()->format('Y-m-d'))
                ->where('appointments.remaining_spots', '>', 0);
        })->selectRaw('distinct events.*');
    }
}
