<?php

namespace App\Models\Traits\Method;

use App\Constants\PaymentConstants;

/**
 * Trait PaymentMethod
 * @package App\Models\Traits\Method
 */
trait PaymentMethod
{
    public function pushStatus($status)
    {
        if (isset(PaymentConstants::STATUSES[$status])) {
            $this->update(['status' => $status]);
        }
    }

    public function isBooking(): bool
    {
        return !is_null($this->booking) && !in_array($this->type, [PaymentConstants::TYPE_REFUND, PaymentConstants::TYPE_CERTIFICATE]);
    }

    public function isCertificate(): bool
    {
        return !is_null($this->booking) && $this->type == PaymentConstants::TYPE_CERTIFICATE;
    }

    public function isSucceeded(): bool
    {
        return $this->status == PaymentConstants::STATUS_SUCCEEDED;
    }
}
