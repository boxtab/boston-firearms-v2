<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Traits\CertificateTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class CertificateController
 * @package App\Http\Controllers
 */
class CertificateController extends Controller
{
    use CertificateTrait;

    /**
     * @param Booking $booking
     *
     * @return Factory|View
     */
    public function paymentShow(Booking $booking)
    {
        return view('pages.certificate.payment', [
            'booking' => $booking,
            'amountToday' => 40,
        ]);
    }

    /**
     * @param Booking $booking
     * @param string $downloadType
     * @return string
     */
    public function frontCertificate(Booking $booking, $downloadType)
    {
        return $this->oneCertificate($booking, $downloadType);
    }
}
