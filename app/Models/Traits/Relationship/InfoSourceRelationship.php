<?php

namespace App\Models\Traits\Relationship;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Trait InfoSourceRelationship
 * @package App\Models\Traits\Relationship
 */
trait InfoSourceRelationship
{
    /**
     * @return HasOne
     */
    public function addedBy(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
