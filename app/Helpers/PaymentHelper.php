<?php

namespace App\Helpers;

use App\Constants\PaymentConstants;

/**
 * Class PaymentHelper
 * @package App\Helpers
 */
class PaymentHelper
{
    /**
     * @param int|null $gateway
     * @return string
     */
    public static function getGatewayText(?int $gateway): string
    {
        return PaymentConstants::GATEWAYS[$gateway] ?? 'Not Selected';
    }

    /**
     * @param int|null $type
     * @return string
     */
    public static function getTypeText(?int $type): string
    {
        return PaymentConstants::TYPES[$type] ?? 'Not Selected';
    }
}
