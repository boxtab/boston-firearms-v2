<?php

namespace App\Notifications;

use App\Channels\EmailChannel;
use App\Channels\SMSChannel;
use App\Settings\SendGrid\SendGridSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Class UpcomingAppointment
 * @package App\Notifications
 */
class UpcomingAppointment extends Notification implements ShouldQueue
{
    use Queueable;

    private $clientFirstName;
    private $dateTimeClass;
    private $clientPhone;
    private $clientEmail;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $this->clientFirstName = $notifiable->first_name;
        $this->dateTimeClass = $notifiable->date_time_class;
        $this->clientPhone = $notifiable->phone;
        $this->clientEmail = $notifiable->email;

        return [
            SMSChannel::class,
            EmailChannel::class,
        ];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        return [
            'message_to' => $this->clientPhone,

            'message_text' => view('notices.sms.upcoming_appointment', [
                'clientFirstName' => $this->clientFirstName,
                'dateTimeClass' => $this->dateTimeClass,
            ]),
        ];
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toEmail($notifiable)
    {
        $sendGridSettings = new SendGridSettings();

        return [
            'api_key' => $sendGridSettings->api_key,
            'email_from' => $sendGridSettings->email_from,
            'email_to' => $this->clientEmail,
            'dynamic_template_data' => [
                'clientFirstName' => $this->clientFirstName,
                'dateTimeClass' => $this->dateTimeClass,
            ],
            'template_id' => $sendGridSettings->template_id_upcoming,
        ];
    }
}
