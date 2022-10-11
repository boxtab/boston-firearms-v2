<?php

namespace App\Models\Traits\Scope;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Trait EventScope
 * @package App\Models\Traits\Scope
 */
trait BookingScope
{
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeBooked($query)
    {
        return $query->where('status', self::STATUS_BOOKED);
    }
}
