<?php

namespace App\Models\Traits\Attribute;

use Illuminate\Support\Facades\Log;

/**
 * Trait UserAttribute
 * @package App\Models\Traits\Attribute
 */
trait UserAttribute
{
    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->last_name;
    }
}
