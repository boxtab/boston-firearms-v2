<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class ContactUsSignUpClassSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->delete('sendgrid.admin');
        $this->migrator->delete('sendgrid.client');
        $this->migrator->delete('sendgrid.upcoming');
        $this->migrator->delete('sendgrid.contact_form');


        $this->migrator->add('sendgrid.template_id_admin');
        $this->migrator->add('sendgrid.template_id_client');
        $this->migrator->add('sendgrid.template_id_upcoming');
        $this->migrator->add('sendgrid.template_id_contact_us');
        $this->migrator->add('sendgrid.template_id_sign_up_class');
    }
}
