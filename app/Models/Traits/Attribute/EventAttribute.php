<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait EventAttribute
 * @package App\Models\Traits\Attribute
 */
trait EventAttribute
{
    /**
     * @return string
     */
    public function getPriceFormatAttribute(): string
    {
        return number_format($this->price, 2);
    }

    /**
     * @return string
     */
    public function getActiveFormatAttribute(): string
    {
        return $this->active == 1 ? 'Active' : 'Inactive';
    }

    /**
     * @return int
     */
    public function getRadiobuttonActiveAttribute(): int
    {
        return is_null($this->active) ? 2 : (int)$this->active + 1;
    }

    /**
     * @return int
     */
    public function getRadiobuttonHasLiveFireAttribute(): int
    {
        return is_null($this->has_live_fire) ? 2 : (int)$this->has_live_fire + 1;
    }
}
