<?php

namespace App\Services;


use App\Constants\PaymentConstants;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Event;
use App\Models\InfoSource;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventMigrateService {

    protected $db = null;
    protected $query = null;
    protected $superAdmin;

    public function __construct()
    {
        $this->db = DB::connection('bf_migration');
        $this->query = new Builder($this->db);
        $this->superAdmin = User::where('id', '=', config('access.users.super_admin.id'))->first();
    }

    public function getEvents()
    {
        return $this->query->from('event')->get();
    }

    public function getEventDaysQuery($eventId, $startDate)
    {
        $query = $this->query->cloneWithoutBindings([]);
        return $query->select('*')
                           ->from('event_day')
                           ->where('event_id', '=', $eventId)
                           ->where('event_dt', '>=', $startDate)
                           ->orderBy('event_dt');
    }

    public function getInfoSources()
    {
        return $this->query->from('info_source')->get();
    }

    public function getAttendees($eventDayId)
    {
        $query = $this->query->cloneWithoutBindings([]);
        return $query->from('attendee')
                     ->where('time_slots', '=', $eventDayId)
                     ->where('blacklist', '=', '')
                     ->where('payment_mode', '!=', '')
                     ->get();
    }

    public function migrateBooking($attendee, $infoSources, Appointment $appointment, Client $client, Payment $payment, ?Client $guestClient = null)
    {
        $existingBooking = Booking::where('appointment_id', '=', $appointment->id)->where('client_id', '=', $client->id)->first();
        $infoSource = null;
        if (!empty($attendee->info_source)) {
            $result = $infoSources->search(function ($item, $key) use ($attendee){
                return $item->old_info_source_id == $attendee->info_source;
            });
            if (false !== $result) {
                $infoSource = $infoSources[$result];
            }
        }


        $data = [
            'appointment_id' => $appointment->id,
            'client_id' => $client->id,
            'payment_id' => $payment->id,
            'info_source_id' => !is_null($infoSource) ? $infoSource->id : null,
            'guests' => !is_null($guestClient) ? $guestClient->id : null,
            'groupon_code' => !empty($attendee->groupon_code) ? $attendee->groupon_code : null,
        ];
        if (!is_null($existingBooking)) {
            $existingBooking->update($data);
            return $existingBooking->refresh();
        }
        return Booking::create($data);
    }

    public function migratePayment($attendee, $eventDay)
    {
        $existingPayment = null;
        if (!empty($attendee->txn_id)) {
            $existingPayment = Payment::where('transaction_id', '=', $attendee->txn_id)->first();
        }

        $gateway = PaymentConstants::GATEWAY_SQUARE_UP;

        if ($attendee->payment_mode == 1) {
            $gateway = PaymentConstants::GATEWAY_CASH;
        } else if ($attendee->payment_mode == 2) {
            $gateway = PaymentConstants::GATEWAY_PAYPAL;
        } else if ($attendee->payment_mode == 3) {
            $gateway = PaymentConstants::GATEWAY_STRIPES;
        }
        $type = PaymentConstants::TYPE_FULL_PAYMENT;
        $amount = $eventDay->reg_fee;
        if ($attendee->payment_amount == '' || $attendee->payment_amount == 1 || $attendee->payment_amount == 3) {
            $type = PaymentConstants::TYPE_FULL_PAYMENT;
        } else if ($attendee->payment_amount == 2){
            $type = PaymentConstants::TYPE_DEPOSIT;
            $amount = $eventDay->advance_fee;
        }
        //since, we migrate only existing attendees set status to Succeeded
        //leave conditions for future updating
        $status = PaymentConstants::STATUS_SUCCEEDED;
        if (strtolower($attendee->payment_status) == 'completed') {
            $status = PaymentConstants::STATUS_SUCCEEDED;
        }
        $data = [
            'gateway' => $gateway,
            'type' => $type,
            'transaction_id' => !empty($attendee->txn_id) ? $attendee->txn_id : null,
            'amount' => (float)$amount,
            'status' => $status
        ];
        if (!is_null($existingPayment)) {
            $existingPayment->update($data);
            return $existingPayment->refresh();
        }

        return Payment::create($data);
    }

    public function migrateClient($attendee, $isGuest = false)
    {
        $existingClient = Client::where('phone', '=', $attendee->phone_no)->first();
        $fName = $attendee->fname;
        $lName = $attendee->lname;
        $phone = $attendee->phone_no;
        $email = $attendee->emailid;
        if ($isGuest) {
            $phone = $attendee->gphone_no;
            $email = $attendee->gemailid;
            if (!empty($attendee->gname)) {
                $guestNames = explode(' ', $attendee->gname);
                $fName = array_shift($guestNames);
                if (!empty($guestNames)) {
                    $lName = implode(' ', $guestNames);
                }
            } else {
                $fName = null;
                $lName = null;
            }
        }
        $data = [
            'first_name' => $fName,
            'last_name' => $lName,
            'phone' => $phone,
            'email' => $email,
            //'date_of_birth',
            'is_guest' => $isGuest,
            'ip_address' => !empty($attendee->ip_address)? $attendee->ip_address : null,
            'squareup_customer_id' => !empty($attendee->squareup_customer_id)? $attendee->squareup_customer_id : null,
            'added_by' => $this->superAdmin->id,
        ];
        if (!is_null($existingClient)) {
            $existingClient->update($data);
            return $existingClient->refresh();
        }

        return Client::create($data);
    }

    public function migrateInfoSource($infoSource)
    {
        $existingInfoSource = InfoSource::where('title', '=', $infoSource->info_source)->first();
        $data = [
            'title' => $infoSource->info_source,
            'added_by' => $this->superAdmin->id,
        ];
        if (!is_null($existingInfoSource)) {
            $existingInfoSource->update($data);
            return $existingInfoSource->refresh();
        }
        return InfoSource::create($data);
    }

    public function migrateEventDay($eventDay, Event $migratedEvent)
    {
        $startTime = date('Y-m-d H:i:s', strtotime($eventDay->event_dt . ' ' . $eventDay->start_tm));
        $endTime = date('Y-m-d H:i:s', strtotime($eventDay->event_dt . ' ' . $eventDay->end_tm));
        $existingAppointment = $migratedEvent->appointments()
                                             ->where('event_date', '=', $eventDay->event_dt)
                                             ->where('start_time', '=', $startTime)
                                             ->where('end_time', '=', $endTime)
                                             ->first();
        $paymentType = PaymentConstants::APPOINTMENT_PAYMENT_OPTION_FULL_PAYMENT;
        if (!empty($eventDay->pay_cash) && strtolower($eventDay->pay_cash) == 'yes') {
            $paymentType = PaymentConstants::APPOINTMENT_PAYMENT_OPTION_CASH;
        } else if (!empty($eventDay->deposit_view) && strtolower($eventDay->deposit_view) == 'yes') {
            $paymentType = PaymentConstants::APPOINTMENT_PAYMENT_OPTION_DEPOSIT;
        }

        $data = [
            'event_id' => $migratedEvent->id,
            'event_date' => $eventDay->event_dt,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'spots' => (int)$eventDay->spots,
            'remaining_spots' => (int)$eventDay->remaining_spots,
            'registration_fee' => (float) $eventDay->reg_fee?? 0.00,
            'deposit_fee' => (float) $eventDay->advance_fee?? 0.00,
            'payment_type' => $paymentType,
            'has_live_fire' => !empty($eventDay->live_fire) && strtolower($eventDay->live_fire) == 'yes',
            'is_guest_allowed' => !empty($eventDay->allow_guests) && strtolower($eventDay->allow_guests) == 'yes',
            'added_by' => $this->superAdmin->id
        ];
        if (is_null($existingAppointment)) {
            return $migratedEvent->appointments()->create($data);
        }
        $existingAppointment->update($data);
        return $existingAppointment->refresh();
    }
    public function migrateEvent($event, $forceCreate = true) {
        $existingEvent = Event::where('slug', '=', $event->url_slug)->first();
        $data = [
            'title' => $event->title,
            'short_description' => $event->small_descrip,
            'description' => $event->main_descrip,
            'price' => (float)$event->price,
            'active' => strtolower($event->visible) == 'active',
            'has_live_fire' => strtolower($event->live_fire) == 'active',
            'slug' => $event->url_slug,
            'is_contact_form_only' => strtolower($event->contact_form) == 'active',
            'added_by'=> $this->superAdmin->id?? config('access.users.super_admin.id'),
        ];
        if (!is_null($existingEvent)) {
            if ($forceCreate) {
                $data['slug'] = $data['slug'] . '-' . uniqid();
                return Event::create($data);
            }
            $existingEvent->update($data);
            return $existingEvent->refresh();
        }
        return Event::create($data);
    }

    public function truncateTable($table, $disableForeignKeys = false) {
        if ($disableForeignKeys) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        DB::table($table)->truncate();
        if ($disableForeignKeys) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }

    public function migrateEvents()
    {
        $events = $this->queryRequest('event');
        if (!empty($events)) {
            try{
                //DB::beginTransaction();
                $superAdmin = User::where('id', '=', config('access.users.super_admin.id'))->first();
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('events')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                foreach ( $events as $event ) {
                    Event::create([
                        'title' => $event->title,
                        'short_description' => $event->small_descrip,
                        'description' => $event->main_descrip,
                        'price' => (float)$event->price,
                        'active' => strtolower($event->visible) == 'active',
                        'has_live_fire' => strtolower($event->live_fire) == 'active',
                        'slug' =>$event->url_slug,
                        'is_contact_form_only' => strtolower($event->contact_form) == 'active',
                        'added_by'=> $superAdmin->id?? config('access.users.super_admin.id'),
                    ]);
                }
                //DB::commit();
            } catch (\Exception $e) {
                //DB::rollBack();
                Log::error("Migrate events: " . $e->getMessage());
                throw new \Exception($e->getMessage());
            }
        }
    }


    protected function queryRequest($table, $fields = [], $where = '', $sortOrder = [], $page = 1, $limit = 100): array
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }
        $fields = count($fields) == 0 ? '*' : implode(',', $fields);
        $sortBy = 'id';
        $sortWay = 'asc';
        if (is_array($sortOrder) && count($sortOrder) == 2) {
            list($sortBy, $sortWay) = $sortOrder;
        }
        $offset = ( $page - 1 ) * $limit;
        $sql = "select ${fields} from ${table} ";
        if (!empty($where)) {
            $sql .= " WHERE " . $where;
        }
        if( ! str_contains( $fields, 'count' ) ) {
            $sql .= "ORDER BY ${sortBy} ${sortWay}";
        }
        $sql .= " LIMIT ${limit} OFFSET ${offset}";

        return $this->db->select($sql);
    }

}
