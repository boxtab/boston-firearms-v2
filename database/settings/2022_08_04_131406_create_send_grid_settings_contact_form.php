<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSendGridSettingsContactForm extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sendgrid.contact_form', null);
    }
}
