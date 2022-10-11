<?php

namespace App\Helpers;

use App\Models\NotificationEvent;
use App\Models\SendgridList;
use App\Settings\SendGrid\SendGridSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SendGrid;
use Exception;

/**
 * Class SendGridHelper
 * @package App\Helpers
 */
class SendGridHelper
{
    private static $sendGrid;

    private static $queryParams;

    private static function fetchInstance()
    {
        $sendGridSettings = new SendGridSettings;

        self::$sendGrid = new SendGrid($sendGridSettings->api_key);
        self::$queryParams = json_decode('{
    "page_size": 100
}');
    }

    /**
     * @param string $contactListId
     * @param string $email
     * @return |null
     */
    public static function getContactIdByEmail(string $contactListId, string $email)
    {
        self::fetchInstance();

        $requestBody = json_decode("{
    \"query\": \"email LIKE '$email' AND CONTAINS(list_ids, '$contactListId')\"
}");

        try {
            $response = self::$sendGrid->client->marketing()->contacts()->search()->post($requestBody);

            $body = $response->body();
            if ( $body == '' ) {
                return null;
            }
        } catch (Exception $ex) {
            echo 'SendGrid exception: '.  $ex->getMessage();
        }

        if ( empty(json_decode($body, true)['result']) ) {
            return null;
        }

        return json_decode($body, true)['result'][0]['id'];
    }

    /**
     * @param string $contactId
     */
    public static function deleteContactById(string $contacId)
    {
        self::fetchInstance();

        $queryParams = json_decode("{
    \"ids\": \"$contacId\"
}");

        try {
            self::$sendGrid->client->marketing()->contacts()->delete(null, $queryParams);
        } catch (Exception $ex) {
            echo 'SendGrid exception: '.  $ex->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public static function fetchContactListsSendGrid()
    {
        self::fetchInstance();

        try {
            $response = self::$sendGrid->client->marketing()->lists()->get(null, self::$queryParams);
            $body = $response->body();
        } catch (Exception $ex) {
            echo 'SendGrid exception: '.  $ex->getMessage();
        }

        return json_decode($body, true)['result'];
    }

    /**
     * @return array
     */
    public static function getContactListsSendGrid()
    {
        $sendgridList = SendgridList::on()
            ->orderBy('id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->name . ' / ' . $item->list_id];
            })
            ->toArray();

        $sendgridList = [0 => 'select'] + $sendgridList;

        return $sendgridList;
    }

    /**
     * @param array $contactLists
     */
    public static function updateContactListSendGrid(array $contactLists)
    {
        $sendgridLists = [];
        foreach ($contactLists as $contactList) {
            $sendgridLists[] = [
                'list_id' => $contactList['id'],
                'name' => $contactList['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('sendgrid_lists')->upsert($sendgridLists, ['list_id'], ['name', 'created_at', 'updated_at']);
    }

    /**
     * @param array $contactLists
     */
    public static function deleteContactListSendGrid(array $contactLists)
    {
        foreach (SendgridList::on()->get() as $sendgridList) {
            $exists = false;
            foreach ($contactLists as $contactList) {
                if ( $contactList['id'] == $sendgridList->list_id ) {
                    $exists = true;
                }
            }

            if ( ! $exists) {
                $sendgridList->delete();
            }
        }
    }

    /**
     * @param int $eventId
     * @return mixed|null
     */
    public static function getContactListIdByEventId(int $eventId)
    {
        $notificationEvent = NotificationEvent::on()
            ->where('id', '=', $eventId)
            ->first();

        $sendgridListId = empty($notificationEvent) ? null : $notificationEvent->sendgrid_list_id;

        if ( ! empty($sendgridListId) ) {
            $contactListId = SendgridList::on()->where('id', '=', $sendgridListId)->first()->list_id;
        } else {
            $contactListId = null;
        }

        return $contactListId;
    }

    /**
     * @param string $contactListId
     * @param string $email
     */
    public static function addOrUpdateContact(string $contactListId, string $email)
    {
        self::fetchInstance();

        $requestBody = json_decode('{
    "list_ids": ["'. $contactListId .'"],
    "contacts": [
        {
            "email": "'. $email .'"
        }
    ]
}');
        try {
            self::$sendGrid->client->marketing()->contacts()->put($requestBody);
        } catch (Exception $ex) {
            echo 'SendGrid exception: '.  $ex->getMessage();
        }
    }

    /**
     * @param string $fieldName
     *
     * @param string $fieldType
     * Allowed Values: Text, Number, Date
     */
    public static function createCustomFieldDefinition(string $fieldName, string $fieldType)
    {
        self::fetchInstance();

        $request_body = json_decode('{
    "name": "'. $fieldName .'",
    "field_type": "' . $fieldType . '"
}');

        try {
            self::$sendGrid->client->marketing()->field_definitions()->post($request_body);
        } catch (Exception $ex) {
            echo 'SendGrid exception: '.  $ex->getMessage();
        }
    }
}
