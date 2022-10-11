<div class="row">
    <div class="col-md">
        <strong>{{ $date }}</strong>
    </div>
    <div class="col-md">
        {{ $numberBooked }} -
        <a class="cc-name-btn"
           href="{{ route('platform.systems.events.day.attendees', ['eventId' => $eventId, 'day' => $date]) }}"
        >View list</a>
    </div>
    <div class="col-md">
        <x-appointment.deleteDay :eventId="$eventId" :eventDate="$date"/>
    </div>
</div>

<div class="row">
    <div class="col-md">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Session</th>
                <th scope="col">Reg. Fee ($)</th>
                <th scope="col">Live Fire</th>
                <th scope="col">T. Spots / R. Spots</th>
                <th scope="col">Attenders / Only Registered</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <td><a class="cc-name-btn"
                           href="{{ route('platform.systems.events.appointment.attendees',  [ 'eventId' => $eventId, 'appointmentId' => $session->id]) }}"
                        >
                            {{ $session->session }}
                        </a>
                    </td>
                    <td>{{ $session->registration_fee_format }}</td>
                    <td>{{ $session->live_fire_format }}</td>
                    <td>{{ $session->spots }} / {{ $session->remaining_spots }}</td>
                    <td>{{ $session->bookings_count }} / {{ $session->bookings_count }}</td>
                    <td><x-appointment.action :appointment="$session"/></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-1">
        <x-appointment.addClass :eventId="$eventId" :eventDate="$date"/>
    </div>
    <div class="col-md-11">
    </div>
</div>

