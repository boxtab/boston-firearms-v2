<?php

namespace App\Models\Traits\Attribute;

use App\Constants\PaymentConstants;

/**
 * Trait PaymentAttribute
 * @package App\Models\Traits\Attribute
 */
trait PaymentAttribute
{
    /**
     * @return string
     */
    public function getGatewayFormatAttribute(): string
    {
        if ( array_key_exists($this->gateway,PaymentConstants::GATEWAYS) ) {
            $gateway = PaymentConstants::TYPES[$this->gateway];
        } else {
            $gateway = 'Not Selected';
        }

        return $gateway;
    }

    /**
     * @return string
     */
    public function getTypeFormatAttribute(): string
    {
        if ( array_key_exists($this->type,PaymentConstants::TYPES) ) {
            $type = PaymentConstants::TYPES[$this->type];
        } else {
            $type = 'Not Selected';
        }

        return $type;
    }
}
