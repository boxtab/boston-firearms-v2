<?php

namespace App\Models\Traits\Method;

/**
 * Trait ClientMethod
 * @package App\Models\Traits\Method
 */
trait ClientMethod
{
    /**
     * @return bool
     */
    public function isGuest(): bool
    {
        return (bool) $this->is_guest;
    }
}
