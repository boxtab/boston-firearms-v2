<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalendarAppointmentsListResource;
use App\Models\Event;
use App\Services\AppointmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class CalendarController
 * @package App\Http\Controllers
 */
class CalendarController extends Controller
{
    /**
     * @param Request $request
     * @param Event $event
     * @param string|null $period date in Y-m-d format
     *
     * @return JsonResponse
     */
    public function getAppointments(Request $request, Event $event, ?string $period = null): JsonResponse
    {
        return response()->json(CalendarAppointmentsListResource::collection(
            (new AppointmentService())->getListByEventQuery( $event, $period)->get() )
        );
    }

}
