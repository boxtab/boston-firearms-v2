<?php

namespace App\Models\Traits\Scope;

trait UserScope
{
    /**
     * Set the request scope to exclude a user with the SuperAdmin role.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('name', '<>', 'super-admin');
    }
}
