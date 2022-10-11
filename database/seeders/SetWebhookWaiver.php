<?php

namespace Database\Seeders;

use App\Services\SmartWaiver\WebhookWaiverService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class SetWebhookWaiver extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apiKey = config('smartwaiver.api_key');
        $webhook = config('smartwaiver.web_hook');

        if ( empty($apiKey) ) {
            $this->command->error('SMARTWAIVER_API_KEY is not set in the .env file');
            return;
        }

        if ( empty($webhook) ) {
            $this->command->error('SMARTWAIVER_WEBHOOK is not set in the .env file');
            return;
        }

        try {
            $webHookWaiverService = new WebhookWaiverService;
            $webHookWaiverService->setWebhook();
            $installedWebhook = $webHookWaiverService->retrieveCurrentWebhook();
            $this->command->info('Installed webhook: ' . $installedWebhook);
        } catch (Exception $e) {
            $this->command->error($e->getMessage());
        }
    }
}
