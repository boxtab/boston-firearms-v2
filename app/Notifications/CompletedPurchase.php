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
 * Class CompletedPurchase
 * @package App\Notifications
 */
class CompletedPurchase extends Notification implements ShouldQueue
{
    use Queueable;

    private $courseName;

    private $dateClass;

    private $linkReject;

    private $linkTransfer;

    public function __construct(array $params = [])
    {
        $this->courseName = $params['courseName']??'';
        $this->dateClass = $params['dateClass']??'';
        $this->linkReject = $params['rejectUrl']??'';
        $this->linkTransfer = $params['rescheduleUrl']??'';
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
            SMSChannel::class,
            ContactListRemoveChannel::class,
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
            'message_to' => $notifiable->phone,

            'message_text' => view('notices.sms.completed_purchase', [
                'clientFirstName' => $notifiable->first_name,
                'dateClass' => $this->dateClass,
                'linkReject' => $this->linkReject,
                'linkTransfer' => $this->linkTransfer,
            ]),
        ];
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toContactList($notifiable)
    {
        return [
            'email' => $notifiable->email,
            'sendgrid_list_id' => SendGridHelper::getContactListIdByEventId(NotificationEventsConstant::ABANDONED_CHECKOUT),
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
            'email_to' => $notifiable->email,
            'dynamic_template_data' => [
                'clientFirstName' => $notifiable->first_name,
                'dateClass' => $this->dateClass,
                'contactEmail' => $sendGridSettings->email_admin,
                'linkReject' => $this->linkReject,
                'linkTransfer' => $this->linkTransfer,
            ],
            'template_id' => $sendGridSettings->template_id_client,
        ];
    }
}
