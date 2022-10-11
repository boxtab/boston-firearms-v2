<?php

namespace App\Orchid\Screens\Appointment;

use App\Constants\BooleanConstant;
use App\Constants\PaymentConstants;
use App\Helpers\DateTimeHelper;
use App\Http\Requests\AppointmentSaveRequest;
use App\Models\Appointment;
use App\Models\Event;
use App\Orchid\Layouts\Appointment\AppointmentCreateListener;
use App\Traits\AppointmentTrait;
use App\Traits\PreviousPageTrait;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Exception;

/**
 * Class AppointmentCreateScreen
 * @package App\Orchid\Screens\Appointment
 */
class AppointmentCreateScreen extends Screen
{
    use AppointmentTrait;
    use PreviousPageTrait;

    /**
     * @var Appointment
     */
    private $appointment;

    /**
     * AppointmentEditScreen constructor.
     */
    public function __construct()
    {
        $this->appointment = new Appointment();
        $this->rememberPage('appointment');
    }

    /**
     * Query data.
     *
     * @param Event $event
     *
     * @return iterable
     */
    public function query(Event $event): iterable
    {
        return [
            'eventPrice' => $event->price,
            'paymentTypes' => PaymentConstants::APPOINTMENT_PAYMENT_OPTIONS,
            'liveFires' => BooleanConstant::YES_NO,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Create appointment';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Create';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'appointment.create',
            'appointment.edit',
            'appointment.show',
            'appointment.delete',
            'appointment.access',
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
            Button::make(__('Cancel'))
                ->icon('close')
                ->novalidate()
                ->method('cancel'),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
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
            AppointmentCreateListener::class,
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function cancel()
    {
        return $this->redirectBack('appointment');
    }

    /**
     * @param Event $event
     * @param AppointmentSaveRequest $request
     * @return RedirectResponse
     */
    public function save(Event $event, AppointmentSaveRequest $request)
    {
        $appointmentsHttp = $request->get('appointments');
        $appointments = [];

        $startDate = $request->get('select_date')['start'];
        $endDate = $request->get('select_date')['end'];

        try {
            $period = DateTimeHelper::getPeriod($startDate, $endDate);
        } catch (Exception $e) {
            Toast::error($e->getMessage());
            return redirect()->back();
        }

        foreach ($period as $key => $value) {
            $eventDate = $value->format('Y-m-d');

            foreach ($appointmentsHttp as $appointmentHttp) {

                $startTime = $eventDate . ' ' . date("H:i", strtotime($appointmentHttp['start_time'])) . ':00';
                $endTime = $eventDate . ' ' . date("H:i", strtotime($appointmentHttp['end_time'])) . ':00';

                $appointments[] = array_merge([
                    'event_id' => $event->id,
                    'event_date' => $eventDate,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'spots' => $appointmentHttp['spots'],
                    'remaining_spots' => $appointmentHttp['spots'],
                    'payment_type' => $appointmentHttp['payment_type'],
                    'has_live_fire' => $appointmentHttp['has_live_fire'],
                    'added_by' => Auth::id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], $this->getFee($appointmentHttp['payment_type'], $appointmentHttp['amount'], $event->price));
            }
        }

        if (!empty($appointments)) {
            Appointment::on()->insert($appointments);
        }

        Toast::info(__('Appointment was saved'));
        return $this->redirectBack('appointment');
    }
}
