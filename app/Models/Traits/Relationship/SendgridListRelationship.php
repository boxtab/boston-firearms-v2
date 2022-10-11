<?php

namespace App\Models\Traits\Relationship;

use App\Models\NotificationEvent;
use App\Models\SendgridList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait SendgridListRelationship
 * @package App\Models\Traits\Relationship
 */
trait SendgridListRelationship
{
    /**
     * @return BelongsToMany
     */
    public function notificationEvents(): BelongsToMany
    {
        return $this->belongsToMany(NotificationEvent::class);
    }
}
