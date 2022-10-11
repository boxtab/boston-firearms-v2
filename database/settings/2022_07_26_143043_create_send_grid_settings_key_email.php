<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSendGridSettingsKeyEmail extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sendgrid.api_key', null);
        $this->migrator->add('sendgrid.email_from', null);
        $this->migrator->add('sendgrid.email_admin', null);
    }
}
