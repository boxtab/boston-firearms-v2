<?php

namespace App\Orchid\Layouts\Appointment;

use App\Constants\PaymentConstants;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class AppointmentEditLayout extends Rows
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
        return [
            DateTimer::make('appointment.event_date')
                ->format('Y-m-d')
                ->required()
                ->horizontal()
                ->title(__('Event date'))
            ,

            DateTimer::make('appointment.start_time')
                ->title('From')
                ->horizontal()
                ->format('h:i K')
                ->allowEmpty()
                ->noCalendar()
                ->serverFormat('h:i a')
                ->required()
            ,

            DateTimer::make('appointment.end_time')
                ->title('To')
                ->horizontal()
                ->format('h:i K')
                ->allowEmpty()
                ->noCalendar()
                ->serverFormat('h:i a')
                ->required()
            ,

            Input::make('appointment.spots')
                ->type('number')
                ->horizontal()
                ->min(0)
                ->required()
                ->title(__('Spots'))
            ,

            Input::make('appointment.remaining_spots')
                ->type('number')
                ->horizontal()
                ->min(0)
                ->required()
                ->title(__('Remaining spots'))
            ,

            Input::make('appointment.registration_fee')
                ->type('number')
                ->horizontal()
                ->min('0.00')
                ->step('0.01')
                ->required()
                ->title(__('Registration Fee'))
            ,

            Input::make('appointment.deposit_fee')
                ->type('number')
                ->horizontal()
                ->min('0.00')
                ->step('0.01')
                ->required()
                ->title(__('Deposit fee'))
            ,

            Select::make('appointment.payment_type')
                ->options(PaymentConstants::APPOINTMENT_PAYMENT_OPTIONS)
                ->horizontal()
                ->required()
                ->title(__('Payment view'))
            ,

            Select::make('appointment.radiobutton_has_live_fire')
                ->options([
                    2 => 'Yes',
                    1 => 'No',
                ])
                ->required()
                ->horizontal()
                ->title('Live Fire')
            ,
        ];
    }
}
