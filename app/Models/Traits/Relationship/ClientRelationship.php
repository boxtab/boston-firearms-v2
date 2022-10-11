<?php

namespace App\Models\Traits\Relationship;

use App\Models\Payment;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Trait ClientRelationship
 * @package App\Models\Traits\Relationship
 */
trait ClientRelationship
{
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
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'client_id');
    }

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'client_id');
    }

    /**
     * @return HasManyThrough
     */
    public function appointments(): HasManyThrough
    {
        return $this->hasManyThrough(Appointment::class, Booking::class, 'client_id', 'id', 'id', 'appointment_id');
    }
}
