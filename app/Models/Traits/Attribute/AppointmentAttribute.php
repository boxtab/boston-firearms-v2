<?php

namespace App\Models\Traits\Attribute;

use App\Models\Client;
use Illuminate\Support\Facades\Log;

/**
 * Trait AppointmentAttribute
 * @package App\Models\Traits\Attribute
 */
trait AppointmentAttribute
{
    /**
     * @return string
     */
    public function getDateTimeFormattedAttribute()
    {
        return date('m/d/Y', strtotime($this->event_date))
               . '('
               . date('D', strtotime($this->event_date))
               . ') From '
               . date('h:i A', strtotime($this->start_time))
               . ' To '
               . date('h:i A', strtotime($this->end_time));
    }

    /**
     * @return string
     */
    public function getDateTimeLessonAttribute()
    {
        return date('m-d-Y', strtotime($this->event_date))
            . ' '
            . date('h:i A', strtotime($this->start_time));
    }

    /**
     * @return false|string
     */
    public function getEventDateFormatAttribute()
    {
        return date('m/d/Y', strtotime($this->event_date));
    }

    /**
     * @return string
     */
    public function getSessionAttribute(): string
    {
        $startTime = date('h:i A' , strtotime($this->start_time));
        $endTime = date('h:i A' , strtotime($this->end_time));

        return "$startTime To $endTime";
    }

    public function getUrlAttribute(): string
    {
        return route('checkout.enter-details.show', ['appointment' => $this->id]);
    }

    /**
     * @return string
     */
    public function getRegistrationFeeFormatAttribute(): string
    {
        return number_format($this->registration_fee, 2);
    }

    /**
     * @return string
     */
    public function getLiveFireFormatAttribute(): string
    {
        return $this->has_live_fire == 1 ? 'Yes' : 'No';
    }

    /**
     * @return string
     */
    public function getGuestAllowedFormatAttribute(): string
    {
        return $this->is_guest_allowed == 1 ? 'Yes' : 'No';
    }

    /**
     * @return int
     */
    public function getRadiobuttonHasLiveFireAttribute(): int
    {
        return is_null($this->has_live_fire) ? 2 : (int)$this->has_live_fire + 1;
    }

    /**
     * @return string
     */
    public function getRescheduleDateTimeAttribute(): string
    {
        return 'On ' .
            date('l, F jS', strtotime($this->event_date)) .
            ' - ' .
            date('H:ia', strtotime($this->start_time));
    }
}
