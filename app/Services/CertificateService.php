<?php

namespace App\Services;

use App\Helpers\DateTimeHelper;
use App\Helpers\StringHelper;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use setasign\Fpdi\Fpdi;
use Exception;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CertificateClassService
 * @package App\Services
 */
class CertificateService
{
    private const PATH_TO_FILE = 'pdf-templates/certificate_blank.pdf';

    /**
     * @var Collection
     */
    private $bookings;

    /**
     * @var User
     */
    private $instructor;

    /**
     * @var array
     */
    private $certificateFields = [];

    /**
     * @var FPDI
     */
    private $pdf;

    /**
     * CertificateClassService constructor.
     *
     * @param Collection $bookings
     * @param User $instructor
     */
    public function __construct(Collection $bookings, User $instructor)
    {
        $this->bookings = $bookings;
        $this->instructor = $instructor;
    }

    private function fillCertificateFields()
    {
        $this->certificateFields = $this->bookings->map(function ($item) {
            return [
                'name' => $item->client->full_name_format,
                'date_of_birth' => date('m/d/Y', strtotime($item->client->date_of_birth)),
                'certified_course_title' => substr($item->appointment->event->title, 0, 60),
                'course_certification_number' => $item->appointment->event->course_certification_number,
                'instructor_name' => $this->instructor->full_name,
                'certification_number' => $this->instructor->certification_number,
                'certification_expiration_date' => DateTimeHelper::getDateUnitedStates($this->instructor->certification_expiration),
                'ltc_expiration_date' => DateTimeHelper::getDateUnitedStates($this->instructor->ltc_expiration),
                'valid_for_ltc' => 'X',
                'valid_for_fid_only' => null,
                'date_course_completed' => $item->appointment->event_date_format,
            ];
        })->toArray();
    }

    private function createCertificates()
    {
        $this->fillCertificateFields();
        $pdf = new FPDI();

        foreach ($this->certificateFields as $certificateField) {
            $pdf->AddPage();

            try {
                $pathToFile = storage_path(self::PATH_TO_FILE);
                $pdf->setSourceFile($pathToFile);
                $tplIdx = $pdf->importPage(1);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $pdf->useTemplate($tplIdx, 0, 0, 297, 210, true);
            $pdf->SetFont('Helvetica');
            $pdf->SetTextColor(0, 0, 0);

            $pdf->SetXY(65, 93);
            $pdf->Write(0, $certificateField['name']);

            $pdf->SetXY(225, 93);
            $pdf->Write(0, $certificateField['date_of_birth']);

            $pdf->SetXY(42, 108);
            $pdf->Write(0, $certificateField['certified_course_title']);

            $pdf->SetXY(220, 108);
            $pdf->Write(0, $certificateField['course_certification_number']);

            $pdf->SetXY(45, 123);
            $pdf->Write(0, $certificateField['instructor_name']);

            $pdf->SetXY(130, 123);
            $pdf->Write(0, $certificateField['certification_number']);

            $pdf->SetXY(190, 123);
            $pdf->Write(0, $certificateField['certification_expiration_date']);

            $pdf->SetXY(230, 123);
            $pdf->Write(0, $certificateField['ltc_expiration_date']);


            $pdf->SetXY(125, 138);
            $pdf->Write(0, $certificateField['valid_for_ltc']);

            $pdf->SetXY(153, 138);
            $pdf->Write(0, $certificateField['valid_for_fid_only']);

            if ( ! empty($this->instructor->signature_path) ) {
                // add signature
                $pdf->Image($this->instructor->signature_path, 80, 157, 32);
            }

            $pdf->SetXY(205, 170);
            $pdf->Write(0, $certificateField['date_course_completed']);

        }

        $this->pdf = $pdf;
    }

    /**
     * @return Fpdi
     */
    public function getCertificates()
    {
        $this->createCertificates();
        return $this->pdf;
    }

    /**
     * @param string $fileName
     */
    public function saveCertificates(string $fileName)
    {
        $this->createCertificates();
        $this->pdf->Output('F', $fileName);
    }

}
