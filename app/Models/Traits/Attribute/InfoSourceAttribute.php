<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait InfoSourceAttribute
 * @package App\Models\Traits\Attribute
 */
trait InfoSourceAttribute
{
    /**
     * @return mixed
     */
    public function getCreatedAtFormatAttribute()
    {
        return date_format($this->created_at, 'm/d/Y');
    }
}
