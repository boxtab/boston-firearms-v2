<?php

namespace App\Models\Traits\Attribute;

use App\Constants\PaymentConstants;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Trait BookingAttribute
 * @package App\Models\Traits\Attribute
 */
trait BookingAttribute
{
    /**
     * @return |null
     */
    public function getGuestsAttribute()
    {
        if (!empty($this->guests)) {
            return Client::whereIn($this->guests)->get();
        }
        return null;
    }

    /**
     * @return string
     */
    public function getVisitedTextAttribute()
    {
        return $this->visited == 1 ? 'Visited' : 'Not visited';
    }

    /**
     * @return string
     */
    public function getWaiverTextAttribute()
    {
        return $this->is_waiver == 1 ? 'Yes' : 'No';
    }

    public function getPaymentsInfoAttribute()
    {
        $payments = $this->succeededPayments->map(function ($payment){
                $info = Str::studly(PaymentConstants::GATEWAYS[$payment->gateway])??'Not Selected';
                $info .= ' / '. Str::studly(PaymentConstants::TYPES[$payment->type])??' / Not Selected';
            return $info;
        });

        return implode("<br/>", $payments->toArray());
    }
}
