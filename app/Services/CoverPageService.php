<?php

namespace App\Services;

use App\Helpers\DateTimeHelper;
use App\Helpers\StringHelper;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use setasign\Fpdi\Fpdi;
use Exception;

/**
 * Class CoverPageService
 * @package App\Services
 */
class CoverPageService
{
    private const PATH_TO_FILE = 'pdf-templates/cover_page_blank.pdf';

    private const NUMBER_ROWS = 15;

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
    private  $listAttendee = [];

    /**
     * @var array
     */
    private $instructorInformation;

    /**
     * @var array
     */
    private $courseInformation;

    /**
     * @var FPDI
     */
    private $pdf;

    /**
     * CoverPageService constructor.
     *
     * @param Collection $bookings
     * @param User $instructor
     */
    public function __construct(Collection $bookings, User $instructor)
    {
        $this->bookings = $bookings;
        $this->instructor = $instructor;
    }

    private function fillListAttendee()
    {
        $this->listAttendee = $this->bookings->map(function ($item) {
            return [
                'last_name' => StringHelper::substr($item->client->last_name, 22),
                'first_name' => StringHelper::substr($item->client->first_name, 22),
                'mi' => null,
                'date_of_birth' => DateTimeHelper::getDateUnitedStates($item->client->date_of_birth),
            ];
        })->toArray();
    }

    private function fillInstructorInformation()
    {
        $this->instructorInformation = [
            'name' => StringHelper::substr($this->instructor->full_name, 20),
            'bfs_certification_number' => StringHelper::substr($this->instructor->certification_number, 13),
            'signature' => StringHelper::substr(null, 18),
            'roster_id' => StringHelper::substr(null, 12),
        ];
    }

    private function fillCourseInformation()
    {
        $appointment = $this->bookings->first()->appointment;

        $this->courseInformation = [
            'course_name' => StringHelper::substr($appointment->event->title, 30),
            'course_certification_number' => $appointment->event->course_certification_number,
            'course_location' => config('bostonfirearms.course_location'),
            'date_completed' => $appointment->event_date_format,
        ];
    }

    private function createCoverPage()
    {
        $this->fillListAttendee();
        $this->fillInstructorInformation();
        $this->fillCourseInformation();

        $pdf = new FPDI();

        $countPage = (int)(ceil(count($this->bookings) / self::NUMBER_ROWS));

        for ($page = 1; $page <= $countPage; $page++) {

            $pdf->AddPage();
            try {
                $pathToFile = storage_path(self::PATH_TO_FILE);
                $pdf->setSourceFile($pathToFile);
                $tplIdx = $pdf->importPage(1);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $pdf->useTemplate($tplIdx, 0, 0, 210, 297, true);
            $pdf->SetFont('Helvetica');
            $pdf->SetTextColor(0, 0, 0);

            $countItem = count($this->bookings) - 1;

            $startItem = ($page - 1) * self::NUMBER_ROWS;
            $endItem = $countItem;

            if (self::NUMBER_ROWS <= $countItem) {
                $endItem = (self::NUMBER_ROWS * $page) - 1;
                if ($endItem > $countItem) {
                    $endItem = $countItem;
                }
            }

            $rowCoefficient = 0;
            for ($item = $startItem; $item <= $endItem; $item++) {
                $y = 71 + $rowCoefficient * 7.5;
                $pdf->SetXY(25, $y);
                $pdf->Write(0, $this->listAttendee[$item]['last_name']);

                $pdf->SetXY(73, $y);
                $pdf->Write(0, $this->listAttendee[$item]['first_name']);

                $pdf->SetXY(123, $y);
                $pdf->Write(0, $this->listAttendee[$item]['mi']);

                $pdf->SetXY(170, $y);
                $pdf->Write(0, $this->listAttendee[$item]['date_of_birth']);

                $rowCoefficient++;
            }

            // Instructors information
            $pdf->SetXY(37, 198);
            $pdf->Write(0, $this->instructorInformation['name']);

            $pdf->SetXY(66, 206);
            $pdf->Write(0, $this->instructorInformation['bfs_certification_number']);

            if ( ! empty($this->instructor->signature_path) ) {
                // add signature
                $pdf->Image($this->instructor->signature_path, 43, 209, 14);
            }

            $pdf->SetXY(43, 214);
            $pdf->Write(0, $this->instructorInformation['signature']);

            $pdf->SetXY(66, 224);
            $pdf->Write(0, $this->instructorInformation['roster_id']);

            $pdf->SetXY(26, 236);
            $pdf->Write(0, $this->instructorInformation['name']);

            // Basic Safety Course Information
            $pdf->SetXY(128, 196);
            $pdf->Write(0, $this->courseInformation['course_name']);

            $pdf->SetXY(153, 204);
            $pdf->Write(0, $this->courseInformation['course_certification_number']);

            $pdf->SetXY(132, 211);
            $pdf->Write(0, $this->courseInformation['course_location']);

            $pdf->SetXY(140, 220);
            $pdf->Write(0, $this->courseInformation['date_completed']);
        }

        $this->pdf = $pdf;
    }

    /**
     * @return string
     */
    public function getCoverPage()
    {
        $this->createCoverPage();
        return $this->pdf->Output('I');
    }

    /**
     * @param string $fileName
     */
    public function saveCoverPage(string $fileName)
    {
        $this->createCoverPage();
        $this->pdf->Output('F', $fileName);
    }
}
