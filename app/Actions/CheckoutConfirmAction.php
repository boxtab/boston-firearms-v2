<?php

namespace App\Actions;

use App\Models\Booking;
use App\Notifications\CompletedPurchase;
use App\Notifications\CompletedPurchaseAdmin;
use Illuminate\Support\Facades\Log;

class CheckoutConfirmAction {

    public function handle(Booking $booking)
    {
            $booking->update([
                'status' => Booking::STATUS_BOOKED
            ]);
            $booking->appointment->update([
                'remaining_spots' => max($booking->appointment->remaining_spots-1, 0)
            ]);

            $booking->client->notify(new CompletedPurchaseAdmin([
                'courseName'=> $booking->appointment->event->title,
                'dateClass' => $booking->appointment->event_date_format,
            ]));


            $booking->client->notify(new CompletedPurchase([
                'courseName'=> $booking->appointment->event->title,
                'dateClass' => $booking->appointment->event_date_format,
                //disabled for a while
                //'rejectUrl' => route('event-reschedule.show', ['bookingHash' => HashHelper::encrypt($booking->id)] ),
                //'rescheduleUrl' => route('event-reschedule.show', ['bookingHash' => HashHelper::encrypt($booking->id)] )
            ]));

    }
}
