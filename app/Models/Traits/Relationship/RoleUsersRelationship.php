<?php

namespace App\Models\Traits\Relationship;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait RoleUsersRelationship
 * @package App\Models\Traits\Relationship
 */
trait RoleUsersRelationship
{
    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }
}
