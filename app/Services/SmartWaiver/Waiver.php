<?php

namespace App\Services\SmartWaiver;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

/**
 * Class Waiver
 * @package App\Services\SmartWaiver
 */
class Waiver
{
    /**
     * Location of the API server
     */
    const BASE_URI ='https://api.smartwaiver.com';

    /**
     * @var Client The Guzzle client used to make requests
     */
    protected $client;

    /**
     * Waiver constructor.
     */
    public function __construct()
    {
        // Add passed in Guzzle options
        $options = array_merge(
            [
                // Do not throw exceptions for 4xx HTTP responses
                'http_errors' => false,
                // Default headers
                'headers' => [
                    'User-Agent' => 'SmartwaiverSDK:4.3.1-php:' . phpversion(),
                    'sw-api-key' => config('smartwaiver.api_key'),
                ]
            ]
        );

        // Set up a new Guzzle Client
        $this->client = new Client($options);
    }
}
