<?php

namespace App\Notifications;

use App\Channels\EmailChannel;
use App\Channels\ContactListRemoveChannel;
use App\Channels\SMSChannel;
use App\Constants\NotificationEventsConstant;
use App\Helpers\SendGridHelper;
use App\Settings\SendGrid\SendGridSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Class CompletedPurchaseAdmin
 * @package App\Notifications
 */
class CompletedPurchaseAdmin extends Notification implements ShouldQueue
{
    use Queueable;

    private $courseName;

    private $dateClass;

    public function __construct(array $params = [])
    {
        $this->courseName = $params['courseName']??'';
        $this->dateClass = $params['dateClass']??'';
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
                'courseName' => $this->courseName,
                'dateClass' => $this->dateClass,
                'firstName' => $notifiable->first_name,
                'lastName' => $notifiable->last_name,
                'contactPhone' => $notifiable->phone,
                'contactEmail' => $notifiable->email,
            ],
            'template_id' => $sendGridSettings->template_id_admin,
        ];
    }
}
