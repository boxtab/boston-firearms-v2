<?php

namespace App\Orchid\Screens\NotificationEvent;

use App\Helpers\SendGridHelper;
use App\Http\Requests\SendGridRequest;
use App\Models\Appointment;
use App\Models\NotificationEvent;
use App\Orchid\Layouts\NotificationEvent\NotificationEventLayout;
use App\Orchid\Layouts\NotificationEvent\SendGridLayout;
use App\Settings\SendGrid\SendGridSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Sight;

/**
 * Class NotificationEventListScreen
 * @package App\Orchid\Screens\SiteEvents
 */
class NotificationEventListScreen extends Screen
{
    /**
     * @var bool
     */
    private $existsSendgridApiKey;

    /**
     * NotificationEventListScreen constructor.
     * @param SendGridSettings $settings
     */
    public function __construct(SendGridSettings $settings)
    {
        $this->existsSendgridApiKey = ($settings->api_key != null);
    }

    /**
     * Query data.
     *
     * @param SendGridSettings $settings
     * @return iterable
     */
    public function query(SendGridSettings $settings): iterable
    {
        return [
            'notificationEvents' => NotificationEvent::on()
                ->defaultSort('id', 'asc')
                ->get(),

            'existsSendgridApiKey' => $this->existsSendgridApiKey,

            'sendgrid.api_key' => $settings->api_key,
            'sendgrid.email_from' => $settings->email_from,
            'sendgrid.email_admin' => $settings->email_admin,

            'sendgrid.template_id_admin' => $settings->template_id_admin,
            'sendgrid.template_id_client' => $settings->template_id_client,
            'sendgrid.template_id_upcoming' => $settings->template_id_upcoming,
            'sendgrid.template_id_contact_us' => $settings->template_id_contact_us,
            'sendgrid.template_id_sign_up_class' => $settings->template_id_sign_up_class,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Notification Events';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All notification events';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'twilio.create',
            'twilio.edit',
            'twilio.show',
            'twilio.delete',
            'twilio.access',
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Refresh contact list'))
                ->icon('list')
                ->novalidate()
                ->method('fetchContactList')
                ->disabled( ! $this->existsSendgridApiKey)
            ,

            Button::make(__('Update'))
                ->icon('check')
                ->novalidate()
                ->method('update')
            ,
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            NotificationEventLayout::class,
            SendGridLayout::class,
        ];
    }

    /**
     * Keep your contact list up to date.
     */
    public function fetchContactList()
    {
        $contactLists = SendGridHelper::fetchContactListsSendGrid();

        SendGridHelper::updateContactListSendGrid($contactLists);
        SendGridHelper::deleteContactListSendGrid($contactLists);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $notificationEvents = $request->get('notification-events');

        if ( ! empty($notificationEvents) ) {
            DB::transaction(function () use ($notificationEvents) {
                foreach ($notificationEvents as $slug => $sendGridListId) {
                    NotificationEvent::on()
                        ->where('slug', '=', $slug)
                        ->update([
                            'sendgrid_list_id' => $sendGridListId == 0 ? null : $sendGridListId,
                        ]);
                }
            });
            Toast::info(__('Notification events was updated'));
        }

        return redirect()->route('platform.systems.notification-events');
    }

    /**
     * @param SendGridSettings $settings
     * @param SendGridRequest $request
     */
    public function saveSettingsSendGrid(SendGridSettings $settings, SendGridRequest $request)
    {
        $sendGrid = $request->get('sendgrid');

        $settings->api_key = $sendGrid['api_key'];
        $settings->email_from = $sendGrid['email_from'];
        $settings->email_admin = $sendGrid['email_admin'];

        $settings->template_id_admin = $sendGrid['template_id_admin'];
        $settings->template_id_client = $sendGrid['template_id_client'];
        $settings->template_id_upcoming = $sendGrid['template_id_upcoming'];
        $settings->template_id_contact_us = $sendGrid['template_id_contact_us'];
        $settings->template_id_sign_up_class = $sendGrid['template_id_sign_up_class'];

        $settings->save();

        Toast::info(__('Settings for SendGrid have been saved successfully'));
    }
}
