<?php

namespace App\Channels;

use App\Helpers\SendGridHelper;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Class TmpContactListAddChannel
 * @package App\Channels
 */
class ContactListAddChannel
{
    /**
     * @param $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toContactList($notifiable);

        if ( ! empty($message['sendgrid_list_id']) && ! empty($message['email']) ) {
            SendGridHelper::addOrUpdateContact($message['sendgrid_list_id'], $message['email']);
        }
    }
}
