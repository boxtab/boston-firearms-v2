<?php

namespace App\Settings\SendGrid;

use Spatie\LaravelSettings\Settings;

/**
 * Class SendGridSettings
 * @package App\Settings\SendGrid
 */
class SendGridSettings extends Settings
{
    public $api_key;

    public $email_from;

    public $email_admin;

    public $template_id_admin;

    public $template_id_client;

    public $template_id_upcoming;

    public $template_id_contact_us;

    public $template_id_sign_up_class;

    public static function group(): string
    {
        return 'sendgrid';
    }
}
