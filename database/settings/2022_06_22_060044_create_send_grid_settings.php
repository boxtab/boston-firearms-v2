<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSendGridSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sendgrid.site_name', 'Spatie');
        $this->migrator->add('sendgrid.site_active', true);
        $this->migrator->add('sendgrid.id', null);
        $this->migrator->add('sendgrid.name', null);
        $this->migrator->add('sendgrid.contact_count', null);
    }
}
