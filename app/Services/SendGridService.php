<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

/**
 * Class SendGridService
 * @package App\Services
 */
class SendGridService
{
    /**
     * Link a transactional email.
     */
    const TRANSACTIONAL_URL = 'https://api.sendgrid.com/v3/mail/send';

    /**
     * @var array
     */
    protected $message;

    /**
     * SendGridEmailService constructor.
     *
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * @throws Exception
     */
    public function send()
    {
        $guzzleClient = new Client($this->getGuzzleOptions());

        try {
            $guzzleClient->request(
                'POST',
                self::TRANSACTIONAL_URL,
                $this->getSendGridOptions()
            );
        } catch (GuzzleException $e) {
            throw new Exception('GuzzleException: ', $e->getMessage());
        }

    }

    /**
     * @return array
     */
    private function getGuzzleOptions()
    {
        return [
            'http_errors' => false,
            'allow_redirects' => true,
            'timeout' => 2000,
            'headers' => [
                'Authorization' => "Bearer " . $this->message['api_key'],
                'Content-Type' => 'application/json',
            ]
        ];
    }

    /**
     * @return array
     */
    private function getSendGridOptions()
    {
        return [
            'body' => json_encode([
                'from' => [
                    'email' => $this->message['email_from']
                ],
                'personalizations' => [
                    [
                        'to' => [['email' => $this->message['email_to']]],
                        'dynamic_template_data' => $this->message['dynamic_template_data']]
                ],
                'template_id' => $this->message['template_id'],
            ])
        ];
    }
}
