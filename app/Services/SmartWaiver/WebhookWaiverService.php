<?php

namespace App\Services\SmartWaiver;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

/**
 * Class WebHookWaiverService
 * @package App\Services\SmartWaiver
 */
class WebhookWaiverService extends Waiver
{
    /**
     * Retrieve the current webhook configuration for the account
     *
     * @return string|null
     * @throws Exception
     */
    public function retrieveCurrentWebhook()
    {
        try {
            $guzzleResponse = $this->client->request('GET', self::BASE_URI . '/v4/webhooks/configure');
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }

        $webhook = json_decode($guzzleResponse->getBody()->getContents())->webhooks;
        return ! (array)$webhook ? null : $webhook->endpoint;
    }

    /**
     * Set the webhook configuration for this account
     *
     * @throws Exception
     */
    public function setWebhook()
    {
        try {
            // Send the request and process the response
            $this->client->request(
                'PUT',
                self::BASE_URI . '/v4/webhooks/configure',
                ['json' =>
                    [
                        'endpoint' => config('smartwaiver.web_hook'),
                        'emailValidationRequired' => 'no',
                    ]
                ]
            );
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Delete the current webhook configuration for the account
     *
     * @throws Exception
     */
    public function deleteWebhook()
    {
        try {
            $this->client->request('DELETE', self::BASE_URI . '/v4/webhooks/configure');
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
