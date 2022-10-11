<?php

namespace App\Notifications;

use App\Channels\EmailChannel;
use App\Settings\SendGrid\SendGridSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * Class SignUpClass
 * @package App\Notifications
 */
class SignUpClass extends Notification
{
    use Queueable;

    /**
     * @var array
     */
    private $fieldsSignUpClass;

    /**
     * Create a new notification instance.
     *
     * @param array $fieldsSignUpClass
     */
    public function __construct(array $fieldsSignUpClass)
    {
        $this->fieldsSignUpClass = $fieldsSignUpClass;
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
                'eventTitle'    => $this->fieldsSignUpClass['event_title'],
                'firstName'     => $this->fieldsSignUpClass['first_name'],
                'lastName'      => $this->fieldsSignUpClass['last_name'],
                'email'         => $this->fieldsSignUpClass['email'],
                'message'       => $this->fieldsSignUpClass['message'],
            ],
            'template_id' => $sendGridSettings->template_id_sign_up_class,
        ];
    }
}
