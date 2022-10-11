<?php

namespace App\Actions;

use App\Http\Requests\Checkout\CheckoutStoreRequest;
use App\Notifications\AbandonedCheckout;
use App\Traits\CheckoutTrait;

class CheckoutClientAction {
    use CheckoutTrait;

    public function handle(CheckoutStoreRequest $request)
    {
        $checkoutData = array_merge_recursive(
            $request->validated('booking'),
            [
                'client' => [
                    'ip_address' => $request->ip()
                ]
            ]
        );
        // create or update client
        $client = (new ClientCreateOrUpdateAction())->handle($checkoutData['client_id']??null, $checkoutData['client']);
        $checkoutData['client_id'] = $client->id;
        $booking = (new BookingCreateOrUpdateAction())->handle($checkoutData);

        $client->notify(new AbandonedCheckout);

        $this->updateBookingSession($request->merge(['booking' => array_merge($request->get('booking'), [
            'booking_id' => $booking->id,
            'client_id' => $booking->client_id
        ])]));

        return $booking;
    }
}
