<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait ClientAttribute
 * @package App\Models\Traits\Attribute
 */
trait ClientAttribute
{
    /**
     * @return string
     */
    public function getIsGuestFormatAttribute(): string
    {
        return $this->is_guest == 1 ? 'Yes' : 'No';
    }

    /**
     * @return string
     */
    public function getFullNameFormatAttribute(): string
    {
        return  $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return int
     */
    public function getRadiobuttonIsGuestAttribute(): int
    {
        return is_null($this->is_guest) ? 1 : (int)$this->is_guest + 1;
    }
}
