<?php

namespace App\Constants;

/**
 * Class PaymentConstants
 * @package App\Constants
 */
class PaymentConstants
{
    const GATEWAY_SQUARE_UP = 1;
    const GATEWAY_PAYPAL = 2;
    const GATEWAY_CASH = 3;
    const GATEWAY_STRIPE = 4;

    const GATEWAYS = [
        self::GATEWAY_SQUARE_UP => 'Square',
        self::GATEWAY_PAYPAL => 'PayPal_Express',
        self::GATEWAY_CASH => 'cash',
    ];

    const GATEWAY_CUSTOMER_REFERENCE_FIELD = [
        self::GATEWAY_SQUARE_UP => 'squareup_customer_id',
        self::GATEWAY_PAYPAL => 'paypal_payer_id',
    ];

    const TYPE_FULL_PAYMENT = 1;
    const TYPE_DEPOSIT = 2;
    const TYPE_DEPOSIT_REST = 3;
    const TYPE_CERTIFICATE = 4;
    const TYPE_REFUND = 5;

    const TYPES = [
        self::TYPE_FULL_PAYMENT => 'full_payment',
        self::TYPE_DEPOSIT => 'deposit',
        self::TYPE_DEPOSIT_REST => 'rest_of_deposit',
        self::TYPE_CERTIFICATE => 'certificate',
        self::TYPE_REFUND => 'refund'
    ];

    const STATUS_PENDING = 1;
    const STATUS_SUCCEEDED = 2;
    const STATUS_CANCELED = 3;
    const STATUS_FAILED = 4;
    const STATUS_REFUNDED = 5;

    const STATUSES = [
        self::STATUS_PENDING => 'pending',
        self::STATUS_SUCCEEDED => 'succeeded',
        self::STATUS_CANCELED => 'canceled',
        self::STATUS_FAILED => 'failed',
        self::STATUS_REFUNDED => 'refunded',
    ];

    const APPOINTMENT_PAYMENT_OPTION_FULL_PAYMENT = 1;
    const APPOINTMENT_PAYMENT_OPTION_DEPOSIT = 2;
    const APPOINTMENT_PAYMENT_OPTION_CASH = 3;
    const APPOINTMENT_PAYMENT_OPTIONS = [
        self::APPOINTMENT_PAYMENT_OPTION_FULL_PAYMENT => 'Full Payment',
        self::APPOINTMENT_PAYMENT_OPTION_DEPOSIT => 'Deposit',
        self::APPOINTMENT_PAYMENT_OPTION_CASH => 'Cash',
    ];
}
