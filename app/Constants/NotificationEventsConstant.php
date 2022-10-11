<?php

namespace App\Constants;

/**
 * Class NotificationEventsConstant
 * @package App\Constants
 */
class NotificationEventsConstant
{
    // Completed Quiz form
    const COMPLETED_QUIZ_FORM = 1;

    // * Abandoned Checkout BUT DID NOT PURCHASE
    const ABANDONED_CHECKOUT = 2;

    // * Completed Purchase
    const COMPLETED_PURCHASE = 3;

    // Changed class through event management link
    const CHANGED_CLASS = 4;

    // * Attended Class
    const ATTENDED_CLASS = 5;

    const NAME = [
        self::COMPLETED_QUIZ_FORM => 'Completed Quiz form',
        self::ABANDONED_CHECKOUT => 'Abandoned Checkout',
        self::COMPLETED_PURCHASE => 'Completed Purchase',
        self::CHANGED_CLASS => 'Changed class through event management link',
        self::ATTENDED_CLASS => 'Attended Class',
    ];

    const SLUG = [
        self::COMPLETED_QUIZ_FORM => 'completed_quiz_form',
        self::ABANDONED_CHECKOUT => 'abandoned_checkout',
        self::COMPLETED_PURCHASE => 'completed_purchase',
        self::CHANGED_CLASS => 'changed_class',
        self::ATTENDED_CLASS => 'attended_class',
    ];
}
