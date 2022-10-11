<?php

namespace App\Services\SmartWaiver;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class WaiverService
 * @package App\Services\SmartWaiver
 */
class WaiverService extends Waiver
{
    /**
     * Retrieve a signed waiver
     *
     * @param string $waiverId
     * @return mixed
     * @throws Exception
     */
    public function retrieveSignedWaiver(string $waiverId)
    {
        try {
            $guzzleResponse = $this->client->request('GET', Waiver::BASE_URI . '/v4/waivers/' . $waiverId);
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }

        $content = json_decode($guzzleResponse->getBody()->getContents());

        if ($content->type == 'error') {
            return null;
        }

        return $content->waiver;
    }
}
