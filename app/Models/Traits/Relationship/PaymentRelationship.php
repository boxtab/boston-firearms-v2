<?php

namespace App\Models\Traits\Relationship;

use App\Models\Booking;
use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Trait PaymentRelationship
 * @package App\Models\Traits\Relationship
 */
trait PaymentRelationship
{
    /**
     * @return HasOne
     */
    public function client(): BelongsTo
    {
        return $this->BelongsTo(Client::class);
    }

    /**
     * @return HasOne
     */
    public function booking(): BelongsTo
    {
        return $this->BelongsTo(Booking::class);
    }
}
