<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function Spatie\Ignition\Config\toArray;
use Exception;
use function Symfony\Component\Mime\toString;

/**
 * Class WaiverCheckinService
 * @package App\Services
 */
class WaiverCheckinService
{
    private $waiver;

    private $clientId;

    private $eventId;

    /**
     * WaiverCheckinService constructor.
     * @param $waiver
     */
    public function __construct($waiver)
    {
        $this->waiver = $waiver;
    }

    public function checkin()
    {
        if ( empty($this->waiver)) {
            return;
        }

        $this->fetchClientId();
        $this->fetchEventId();

        if (is_null($this->clientId) || is_null($this->eventId)) {
            return;
        }

        DB::beginTransaction();
        try {
            Client::on()
                ->where('id', '=', $this->clientId)
                ->update(['date_of_birth' => $this->waiver->dob]);


            $appointmentIds = Appointment::on()
                ->where('event_id', '=', $this->eventId)
                ->get()
                ->map(function ($appointment) {
                    return $appointment->id;
                })
                ->toArray();

            Booking::on()
                ->where('client_id', '=', $this->clientId)
                ->whereIn('appointment_id', $appointmentIds)
                ->update(['is_waiver' => 1]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    private function fetchClientId()
    {
        $client = Client::on()
            ->where('first_name', '=', $this->waiver->firstName)
            ->where('last_name', '=', $this->waiver->lastName)
//            ->where('phone', '=', $this->waiver->emergencyContactPhone)
            ->where('email', '=', $this->waiver->email)
//            ->whereDate('date_of_birth', '=', $this->waiver->dob)
            ->first();

        if ( ! empty($client) ) {
            $this->clientId = $client->id;
        }
    }

    private function fetchEventId()
    {
        $customWaiverFields = (array)$this->waiver->customWaiverFields;
        $customWaiverFieldsArrayKey = array_values($customWaiverFields);
        $customWaiverFirstField = array_shift($customWaiverFieldsArrayKey);
        $customWaiverValue = ((array)$customWaiverFirstField)['value'];

        $event = Event::on()->where('waiver', '=', $customWaiverValue)->first();
        if ( empty($event) ) {
            return;
        }

        $this->eventId = $event->id;
    }
}
