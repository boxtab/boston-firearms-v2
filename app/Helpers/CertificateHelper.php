<?php

namespace App\Helpers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

/**
 * Class CertificateHelper
 * @package App\Helpers
 */
class CertificateHelper
{
    /**
     * @param Event $event
     * @param string $day
     * @return string
     */
    public static function getFileNameEventDay(Event $event, string $day): string
    {
        return 'Certificates-from-the-' . $day . '-of-'. str_slug(substr($event->title, 0, 64)) . '.pdf';
    }

    /**
     * @param Appointment $appointment
     * @return string
     */
    public static function getFileNameAppointment(Appointment $appointment): string
    {
        return 'Certificate-for-' .
            str_slug($appointment->date_time_lesson) .
            '-of-' .
            str_slug(substr($appointment->event->title, 0, 64)) .
            '.pdf';
    }

    /**
     * @param Booking $booking
     * @return string
     */
    public static function getFileNameBooking(Booking $booking): string
    {
        $fullName = str_slug($booking->client->full_name_format);
        $courseName = str_slug(substr($booking->appointment->event->title, 0, 64));
        $dateTime = str_slug($booking->appointment->date_time_lesson);

        return "Certificate-for-$fullName-for-completing-a-$courseName $dateTime.pdf";
    }
}
