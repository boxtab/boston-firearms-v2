<?php

namespace App\Models\Traits\Relationship;

use App\Constants\PaymentConstants;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\InfoSource;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait BookingRelationship
 * @package App\Models\Traits\Relationship
 */
trait BookingRelationship
{
    /**
     * @return BelongsTo
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'booking_id');
    }

    public function succeededPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'booking_id')->where('status', PaymentConstants::STATUS_SUCCEEDED);
    }

    /**
     * @return BelongsTo
     */
    public function infoSource(): BelongsTo
    {
        return $this->belongsTo(InfoSource::class);
    }
}
