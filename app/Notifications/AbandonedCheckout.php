<?php

namespace App\Notifications;

use App\Channels\ContactListAddChannel;
use App\Constants\NotificationEventsConstant;
use App\Helpers\SendGridHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Class AbandonedCheckout
 * @package App\Notifications
 */
class AbandonedCheckout extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            ContactListAddChannel::class,
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
}
