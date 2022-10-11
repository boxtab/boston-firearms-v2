<?php

namespace App\Channels;

use App\Services\SendGridService;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Class EmailChannel
 * @package App\Channels
 */
class EmailChannel
{
    /**
     * @param $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toEmail($notifiable);

        try {
            $sendGridService = new SendGridService($message);
            $sendGridService->send();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
