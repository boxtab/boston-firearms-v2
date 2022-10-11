<?php

namespace App\Channels;

use App\Helpers\SendGridHelper;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Class ContactListRemoveChannel
 * @package App\Channels
 */
class ContactListRemoveChannel
{
    /**
     * @param $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toContactList($notifiable);

        if ( ! empty($message['sendgrid_list_id']) && ! empty($message['email']) ) {

            $contactId = SendGridHelper::getContactIdByEmail($message['sendgrid_list_id'], $message['email']);
            if ( ! is_null($contactId) ) {
                SendGridHelper::deleteContactById($contactId);
            }
        }
    }
}
