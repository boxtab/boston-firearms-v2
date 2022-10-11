<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;
use Exception;

/**
 * Class TwilioHelper
 * @package App\Helpers
 */
class TwilioHelper
{
    /**
     * @param string $messageTo
     * @param string $messageText
     * @throws \Twilio\Exceptions\TwilioException
     */
    public static function sendSMS(string $messageTo, string $messageText)
    {
        $sid = config('twilio.account_sid');
        $token = config('twilio.auth_token');
        $smsFrom = config('twilio.sms_from');

        if (empty($sid) || empty($token) || empty($smsFrom)) {
            return;
        }

        try {
            $twilio = new Client($sid, $token);
        } catch (ConfigurationException $e) {
            Log::error('Error configuration Twilio: ' . $e->getMessage());
        }

        try {
            $twilio->messages
                ->create('whatsapp:' . $messageTo,
                    [
                        "body" => $messageText,
                        "from" => $smsFrom,
                    ]
                );
        } catch (Exception $e) {
            Log::error('Error when sending SMS to Twilio: ' . $e->getMessage());
        }
    }
}
