<?php

namespace App\Http\Controllers;

use App\Channels\EmailChannel;
use App\Channels\SMSChannel;
use App\Http\Requests\ContactUsRequest;
use App\Notifications\ContactUs;
use App\Settings\SendGrid\SendGridSettings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{
    public function showAboutUs()
    {
        return view('pages.about_us');
    }
    public function showGiftCards()
    {
        return view('pages.gift_cards');
    }

    public function showContactUs()
    {
        return view('pages.contact_us');
    }

    /**
     * @param ContactUsRequest $request
     * @param SendGridSettings $settings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeContactUs(ContactUsRequest $request, SendGridSettings $settings)
    {
        Notification::route(EmailChannel::class, $settings->email_admin)
            ->notify(
                new ContactUs($request->get('contact_us'))
            );

        return redirect()->back();
    }

    public function showLaneReservation()
    {
        return view('pages.lane_reservation');
    }

    public function showQuiz()
    {
        return view('pages.quiz.quiz-maxim');
    }

    public function showBasicFirearmsSafetyCourse()
    {
        return view('pages.basic_firearms_safety_course');
    }

    public function showStateCourse()
    {
        return view('pages.state_course');
    }
}
