<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSendGridSettingsTemplates extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->delete('sendgrid.site_name');
        $this->migrator->delete('sendgrid.site_active');
        $this->migrator->delete('sendgrid.id');
        $this->migrator->delete('sendgrid.name');
        $this->migrator->delete('sendgrid.contact_count');

        $this->migrator->add('sendgrid.admin', null);
        $this->migrator->add('sendgrid.client', null);
        $this->migrator->add('sendgrid.upcoming', null);
    }
}
