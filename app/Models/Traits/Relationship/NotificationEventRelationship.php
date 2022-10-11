<?php

namespace App\Models\Traits\Relationship;

use App\Models\Event;
use App\Models\SendgridList;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Trait NotificationEventRelationship
 * @package App\Models\Traits\Relationship
 */
trait NotificationEventRelationship
{
    /**
     * @return BelongsTo
     */
    public function sendgridList(): BelongsTo
    {
        return $this->belongsTo(SendgridList::class);
    }
}
