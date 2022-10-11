<?php

namespace App\Models\Traits\Relationship;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait AppointmentRelationship {

    /**
     * @return HasOne
     */
    public function addedBy(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function sessions()
    {
        return $this->hasMany(Appointment::class,'event_id', 'event_id')->where('event_date', $this->event_date);
    }

}
