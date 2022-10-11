<?php

namespace App\Traits;

use App\Helpers\CertificateHelper;
use App\Helpers\UserHelper;
use App\Models\Booking;
use App\Models\User;
use App\Services\CertificateService;
use App\Services\CoverPageService;
use App\Services\ConcatPdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Orchid\Support\Facades\Toast;

/**
 * Trait CertificateTrait
 * @package App\Traits
 */
trait CertificateTrait
{
    /**
     * @param Collection $bookings
     * @param User $instructor
     * @return ConcatPdf
     */
    private function getListCertificates(Collection $bookings, User $instructor)
    {
        $pdfTemporary = 'pdf-temporary';
        File::ensureDirectoryExists(storage_path($pdfTemporary) , 0777);
        $uniqueId = uniqid();

        $fileNameCover = storage_path($pdfTemporary . '/cover-page-' . $uniqueId . '.pdf');
        $coverPageService  = new CoverPageService($bookings, $instructor);
        $coverPageService->saveCoverPage($fileNameCover);

        $fileNameCertificate = storage_path($pdfTemporary . '/certificates-page' . $uniqueId . '.pdf');
        $certificateService  = new CertificateService($bookings, $instructor);
        $certificateService->saveCertificates($fileNameCertificate);

        $pdf = new ConcatPdf();
        $pdf->setFiles(array($fileNameCover, $fileNameCertificate));
        try {
            $pdf->concat();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        unlink($fileNameCover);
        unlink($fileNameCertificate);

        return $pdf;
    }

    /**
     * @param Booking $booking
     * @param string $downloadType
     * @return string
     */
    private function oneCertificate(Booking $booking, string $downloadType = 'I')
    {
        $bookings = Collection::make(
            collect([$booking])
        );

        abort_if(! $this->isValidBooking($bookings), 404);

        $certificateService = new CertificateService($bookings, UserHelper::instructor());
        $pdfCertificate = $certificateService->getCertificates();

        return $pdfCertificate->Output($downloadType, CertificateHelper::getFileNameBooking($booking));
    }

    /**
     * @param Collection $bookings
     * @return bool
     */
    private function isValidBooking(Collection $bookings): bool
    {
        $validBooking = true;
        foreach ($bookings as $booking) {
            if ( empty($booking->client->date_of_birth) ) {
                $validBooking = false;
            }
        }
        return $validBooking;
    }
}
