<?php

namespace App\Http\Controllers\Checkout;

use App\Actions\CheckoutClientAction;
use App\Traits\CheckoutTrait;
use App\Http\Requests\Checkout\CheckoutStoreRequest;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

/**
 * Class EnterDetailsController
 * @package App\Http\Controllers
 */
class EnterDetailsController extends Controller
{
    use CheckoutTrait;

    /**
     * @param Appointment $appointment
     *
     * @return Factory|View
     */
    public function show(Appointment $appointment)
    {
        $this->updateBookingSession(request()->merge(['booking' => [ 'appointment_id'=>$appointment->id ]]));
        return view('pages.checkout.enter-details', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * @param CheckoutStoreRequest $request
     * @param CheckoutClientAction $action
     *
     * @return RedirectResponse
     */
    public function store(CheckoutStoreRequest $request, CheckoutClientAction $action)
    {
        return redirect()->route('checkout.make-payment.show', [
            'booking' => $action->handle($request)->id
        ]);
    }
}
