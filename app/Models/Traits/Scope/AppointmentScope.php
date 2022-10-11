<?php

namespace App\Models\Traits\Scope;

use Carbon\Carbon;

/**
 * Trait AppointmentScope
 * @package App\Models\Traits\Scope
 */
trait AppointmentScope
{
    public function scopeOnlyDate($query, $appointmentDate)
    {
        return $query->where('event_date', Carbon::make($appointmentDate));
    }
}
