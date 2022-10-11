<?php

namespace App\Http\Controllers;

use App\Channels\EmailChannel;
use App\Http\Requests\ContactFormSignUpRequest;
use App\Models\Event;
use App\Notifications\SignUpClass;
use App\Services\AppointmentService;
use App\Settings\SendGrid\SendGridSettings;
use App\Traits\CheckoutTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Notification;
use App\Http\Resources\CalendarAppointmentsListResource;

/**
 * Event ClassController
 * @package App\Http\Controllers
 */
class ClassController extends Controller
{
    use CheckoutTrait;
    /**
     * @param Event $event
     * @param AppointmentService $appointmentService
     *
     * @return Factory|View
     */
    public function index(Event $event, AppointmentService $appointmentService): Factory|View
    {
        $this->clearBookingSession();

        return view('pages.class', [
            'class' => $event,
            'appointments' => CalendarAppointmentsListResource::collection( $appointmentService->getListByEventQuery($event)->get() ),
            'other_classes' => Event::query()
                                    ->active()
                                    ->whereIn('id', [19,3,18]) //TODO - must be refactored to get "otherClasses" in more flexible way
                                    ->get()
        ]);
    }

    /**
     * @param ContactFormSignUpRequest $request
     * @param SendGridSettings $settings
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function classContactFormSignUp(ContactFormSignUpRequest $request, SendGridSettings $settings)
    {
        $this->clearBookingSession();

        $event = Event::find($request->get('event_id'));
        $fieldsSignUpClass = [
            'event_title' => $event->title,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'message' => $request->get('message'),
        ];

        Notification::route(EmailChannel::class, $settings->email_admin)
            ->notify(
                new SignUpClass($fieldsSignUpClass)
            );

        $this->updateBookingSession($request);

        return redirect( route('checkout.thank-you') );
    }
}
