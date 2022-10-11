<?php

namespace App\Models\Traits\Relationship;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait BlacklistRelationship
 * @package App\Models\Traits\Relationship
 */
trait BlacklistRelationship
{
    /**
     * @return belongsTo
     */
    public function booking(): belongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * @return BelongsTo
     */
    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
