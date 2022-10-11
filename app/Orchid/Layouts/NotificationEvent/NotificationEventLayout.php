<?php

namespace App\Orchid\Layouts\NotificationEvent;

use App\Helpers\SendGridHelper;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class NotificationEventLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        $fields = [];
        $notificationEvents = $this->query->get('notificationEvents');

        $existsSendgridApiKey = $this->query->get('existsSendgridApiKey');

        if ( $existsSendgridApiKey) {
            foreach ($notificationEvents as $notificationEvent) {

                $fields[] = Select::make('notification-events.' . $notificationEvent->slug)
                    ->options(
                        SendGridHelper::getContactListsSendGrid()
                    )
                    ->horizontal()
                    ->value((int)$notificationEvent->sendgrid_list_id)
                    ->title(__($notificationEvent->name));
            }
        } else {
            $fields[] = TextArea::make('description')
                ->value('The API KEY field is not defined in the SendGrid settings form!');
        }

        return $fields;
    }
}
