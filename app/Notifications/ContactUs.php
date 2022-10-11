<?php

namespace App\Notifications;

use App\Channels\EmailChannel;
use App\Channels\SMSChannel;
use App\Settings\SendGrid\SendGridSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Class ContactUs
 * @package App\Notifications
 */
class ContactUs extends Notification
{
    use Queueable;

    /**
     * @var array
     */
    private $fieldsContactUs;

    /**
     * Create a new notification instance.
     *
     * @param array $fieldsContactUs
     */
    public function __construct(array $fieldsContactUs)
    {
        $this->fieldsContactUs = $fieldsContactUs;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            EmailChannel::class,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     * @return array
     */
    public function toEmail($notifiable)
    {
        $sendGridSettings = new SendGridSettings();
        return [
            'api_key' => $sendGridSettings->api_key,
            'email_from' => $sendGridSettings->email_from,
            'email_to' => $sendGridSettings->email_admin,
            'dynamic_template_data' => [
                'firstName'     => $this->fieldsContactUs['first_name'],
                'lastName'      => $this->fieldsContactUs['last_name'],
                'email'         => $this->fieldsContactUs['email'],
                'phone'         => $this->fieldsContactUs['phone'],
                'message'       => $this->fieldsContactUs['message'],
            ],
            'template_id' => $sendGridSettings->template_id_contact_us,
        ];
    }
}
