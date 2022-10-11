<?php

namespace App\Models\Traits\Method;

use App\Constants\PaymentConstants;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Trait BookingMethod
 * @package App\Models\Traits\Method
 */
trait BookingMethod
{
    /**
     * @return array
     */
    public function getDataForPayment(): array
    {
        return [
            'amount' => $this->getAmountToPay(),
            'client_id' => $this->client->id,
            'note' => $this->appointment->event->title
        ];
    }

    public function getAmountToPay()
    {
        //$payments = $this->payments()->succeeded()->sum('amount');
        return $this->appointment->getInitialAmount();
    }

    public function getRestAmount()
    {
        return $this->appointment->registration_fee - $this->appointment->deposit_fee;
    }

    public function isCash(): bool
    {
        return (bool) $this->appointment->payment_type == PaymentConstants::APPOINTMENT_PAYMENT_OPTION_CASH;
    }

    /***
     * @return bool
     */
    public function isVisited(): bool
    {
        return (bool) $this->visited;
    }

    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->succeededPayments()
            ->whereIn('type', [PaymentConstants::TYPE_FULL_PAYMENT, PaymentConstants::TYPE_DEPOSIT, PaymentConstants::TYPE_DEPOSIT_REST])
            ->exists();
    }
}
