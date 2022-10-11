<?php

namespace App\Http\Resources;

use App\Models\Appointment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class CalendarAppointmentsListResource extends JsonResource
{
    public $resource = Appointment::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->event_date_format,
            'date_time' => $this->date_time_formatted,
            'title' => $this->session . ' - ' . $this->remaining_spots . '/' . $this->spots . ' Spot(s)',
            'url' => $this->url,
            'reschedule_date_time' => $this->reschedule_date_time,
        ];
    }
}
