<?php

namespace App\Traits;

/**
 * Trait DateTimeTrait
 * @package App\Traits
 */
trait DateTimeTrait
{
    /**
     * @param string|null $time
     * @return string|null
     */
    private function getTimeWithSeconds(?string $time): ?string
    {
        return is_null($time) ? null : $time . ':00';
    }
}
