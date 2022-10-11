<?php

namespace App\Models\Traits\Method;

use App\Models\Appointment;

/**
 * Trait EventMethod
 * @package App\Models\Traits\Method
 */
trait EventMethod
{
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->active;
    }

    public function hasLiveFire(): bool
    {
        return (bool) $this->has_live_fire;
    }

    public function isContactFormOnly(): bool
    {
        return (bool) $this->is_contact_form_only;
    }

    public function hasCustomTemplate(): bool
    {
        return  !empty($this->custom_template);
    }

    public function IsFeatured(): bool
    {
        return  (bool)$this->is_featured;
    }

    /**
     * @return int
     */
    public function getCountAppointments(): int
    {
        return Appointment::on()
            ->where('event_id', '=', $this->id)
            ->count();
    }

    /**
     * @return int
     */
    public function getAttendeesCount(): int
    {
        return $this->bookings()->count();
    }
}
