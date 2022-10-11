<?php

namespace App\Models\Traits\Scope;

use App\Constants\PaymentConstants;
use App\Constants\QuizConstants;

/**
 * Trait PaymentScope
 * @package App\Models\Traits\Scope
 */
trait PaymentScope
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeSucceeded($query): mixed
    {
        return $query->where('status', PaymentConstants::STATUS_SUCCEEDED);
    }

}
