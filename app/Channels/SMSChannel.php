<?php

namespace App\Channels;

use App\Helpers\TwilioHelper;
use App\Services\SendGridService;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Class TmpSMSChannel
 * @package App\Channels
 */
class SMSChannel
{
    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        TwilioHelper::sendSMS($message['message_to'], $message['message_text']);
    }
}
