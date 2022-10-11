<?php

namespace App\Models\Traits\Relationship;

use App\Models\RoleUsers;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait RoleRelationship
 * @package App\Models\Traits\Relationship
 */
trait RoleRelationship
{
    /**
     * @return HasMany
     */
    public function roleUsers(): HasMany
    {
        return $this->hasMany(RoleUsers::class);
    }
}
