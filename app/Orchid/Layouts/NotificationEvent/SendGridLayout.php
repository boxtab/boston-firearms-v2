<?php

namespace App\Orchid\Layouts\NotificationEvent;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class SendGridLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = 'SendGrid settings';

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('sendgrid.api_key')
                ->type('text')
                ->max(128)
                ->horizontal()
                ->title(__('API KEY')),

            Input::make('sendgrid.email_from')
                ->type('text')
                ->max(128)
                ->horizontal()
                ->title(__('Email from')),

            Input::make('sendgrid.email_admin')
                ->type('text')
                ->max(128)
                ->horizontal()
                ->title(__('Email admin')),


            Input::make('sendgrid.template_id_admin')
                ->type('text')
                ->max(64)
                ->horizontal()
                ->title(__('Template Id Admin')),

            Input::make('sendgrid.template_id_client')
                ->type('text')
                ->max(64)
                ->horizontal()
                ->title(__('Template Id Client')),

            Input::make('sendgrid.template_id_upcoming')
                ->type('text')
                ->max(64)
                ->horizontal()
                ->title(__('Template Id Upcoming')),

            Input::make('sendgrid.template_id_contact_us')
                ->type('text')
                ->max(64)
                ->horizontal()
                ->title(__('Template Id Contact Us')),

            Input::make('sendgrid.template_id_sign_up_class')
                ->type('text')
                ->max(64)
                ->horizontal()
                ->title(__('Template Id Sign Up Class')),

            Button::make(__('Save settings for SendGrid'))
                ->type(Color::DEFAULT())
                ->icon('layers')
                ->method('saveSettingsSendGrid')
            ,
        ];
    }
}
