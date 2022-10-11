<?php

namespace App\Http\Controllers;

use App\Helpers\CertificateHelper;
use App\Helpers\UserHelper;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Event;
use App\Traits\CertificateTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Orchid\Support\Facades\Toast;

/**
 * Class CertificateBackOfficeController
 * @package App\Http\Controllers
 */
class CertificateBackOfficeController
{
    use CertificateTrait;

    /**
     * @param Appointment $appointment
     * @param string $downloadType
     * @return string
     */
    public function classCertificate(Appointment $appointment, string $downloadType = 'I')
    {
        $bookings = Booking::on()
            ->where('appointment_id', '=', $appointment->id)
            ->where('visited', '=', 1)
            ->with('client')
            ->with('appointment')
            ->get();

        if (count($bookings) === 0) {
            Toast::error(__('There are no students in the class to print certificates!'));
            return redirect()->back();
        }

        if ( ! $this->isValidBooking($bookings) ) {
            Toast::error(__('There are clients for whom the date of birth is not filled in!'));
            return redirect()->back();
        }

        $pdfCertificate = $this->getListCertificates($bookings, UserHelper::instructor());

        return $pdfCertificate->Output($downloadType, CertificateHelper::getFileNameAppointment($appointment));
    }

    /**
     * @param Booking $booking
     * @param string $downloadType
     * @return RedirectResponse|string
     */
    public function studentCertificate(Booking $booking, string $downloadType = 'I')
    {
        $bookings = Collection::make(
            collect([$booking])
        );

        if (count($bookings) === 0) {
            Toast::error(__('There is no data on the student to print the certificate!'));
            return redirect()->back();
        }

        if ( ! $booking->isVisited() ) {
            Toast::error(__('The student did not attend the class!'));
            return redirect()->back();
        }

        if ( ! $this->isValidBooking($bookings) ) {
            Toast::error(__('The client date of birth is not filled in!'));
            return redirect()->back();
        }

        return $this->oneCertificate($booking, $downloadType);
    }
}
