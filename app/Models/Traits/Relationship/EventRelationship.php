<?php

namespace App\Models\Traits\Relationship;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait EventRelationship {

    /**
     * @return HasOne
     */
    public function addedBy(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * @return HasMany
     */
    public function availableAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class)->where('event_date', '>=', now()->format('Y-m-d'))->where('remaining_spots', '>', 0);
    }

    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, Appointment::class, 'event_id', 'appointment_id', 'id', 'id');
    }
}
