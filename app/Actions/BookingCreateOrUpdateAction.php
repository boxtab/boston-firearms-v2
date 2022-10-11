<?php


namespace App\Actions;


use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingCreateOrUpdateAction {

    /**
     * @param array $bookingData
     *
     * @return Booking
     */
    public function handle(array $bookingData): Booking
    {
        return DB::transaction(function() use ($bookingData){
            if (!empty($bookingData['booking_id'])) {
                $booking = Booking::find($bookingData['booking_id']);
                $booking->update($bookingData);
            } else {
                $booking = Booking::create($bookingData);
            }
            //$booking->update($bookingData);

            return $booking->refresh();
        });
    }

}
