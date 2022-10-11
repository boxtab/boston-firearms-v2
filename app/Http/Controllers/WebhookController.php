<?php

namespace App\Http\Controllers;

use App\Services\SmartWaiver\WaiverService;
use App\Services\WaiverCheckinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Spatie\Ignition\Config\toArray;

/**
 * Class WebhookController
 * @package App\Http\Controllers
 *
 * Documentation:
 * https://support.smartwaiver.com/hc/en-us/articles/360057049551
 *
 */
class WebhookController extends Controller
{
    /**
     * “event” describes what prompted the webhook.
     *  For now this is exclusively “new-waiver” but this allows
     *  us to expand the purpose of webhooks in the future.
     *  It would be wise (in preparation for future expansion)
     *  to write your script to ignore events other than “new-waiver” for now).
     */
    private const EVENT = 'new-waiver';

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function retrieveWaiver(Request $request)
    {
        $uniqueId = $request->get('unique_id');
        $credential = $request->get('credential');
        $event = $request->get('event');
        $webhookPrivateKey = getenv('SMARTWAIVER_WEBHOOK_PRIVATE_KEY');
        $md5 = md5($webhookPrivateKey . $uniqueId);

        /*
         * TODO
         * To verify the integrity of the HTTP POST Request, be sure that the value of POST key “credential” is equivalent to:
         * md5(<Webhook PrivateKey><Waiver UniqId>)
         * If “credential” is not set or not equivalent to the MD5 value above, the HTTP POST Request was corrupted and should be ignored.
         */
//        if (self::EVENT == $event && $md5 == $credential) {
//            null;
//        }


        $waiverService = new WaiverService;
        $waiver = $waiverService->retrieveSignedWaiver($uniqueId);

        $waiverCheckinService = new WaiverCheckinService($waiver);
        $waiverCheckinService->checkin();

        return response()->json();
    }
}
