<form action="{{ route('checkout.enter-details.store', ['appointment' => '#appointment_id#']) }}" method="post" id="home-class-sign-up">
    @csrf
    <div class="field-block">
        <label for="first">First Name</label>
        <input id="first"
               name="booking[client][first_name]"
               maxlength="255"
               placeholder="Enter here"
               value="{{old('booking.client.first_name') ?? ''}}"
               required
               class="@error('booking.client.first_name')is-invalid @enderror"
        >
        @error('booking.client.first_name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="field-block">
        <label for="last">Last Name</label>
        <input id="last"
               name="booking[client][last_name]"
               maxlength="255"
               placeholder="Enter here"
               value="{{old('booking.client.last_name') ?? ''}}"
               required
               class="@error('booking.client.last_name')is-invalid @enderror"
        >
        @error('booking.client.last_name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="field-block">
        <label for="mobile">Mobile Phone</label>
        <input id="mobile"
               name="booking[client][phone]"
               maxlength="64"
               placeholder="Enter here"
               value="{{old('booking.client.phone') ?? ''}}"
               required
               class="@error('booking.client.phone')is-invalid @enderror"
        >
        @error('booking.client.phone')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="field-block">
        <label for="email">Email Address</label>
        <input id="email"
               name="booking[client][email]"
               maxlength="255"
               value="{{old('booking.client.email') ?? ''}}"
               placeholder="Enter here"
               required
               class="@error('booking.client.email')is-invalid @enderror"
        >
        @error('booking.client.email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <div class="field-block field-block--select">
        <label for="date">Date & Time</label>
        <select name="booking[appointment_id]" required>
            <option value="-1">Select</option>
        </select>
    </div>
    <div class="field-block field-block--select">
        <label for="course">Pick Your Course</label>
        <select name="booking[event_id]" required>
            <option value="-1">Select</option>
            @if( ! empty($events) )
            @foreach($events as $event)
            <option value="{{$event->id}}">
                {{$event->title}}
            </option>
            @endforeach
            @endif
        </select>
    </div>

    <div class="agree-row">
        I agree by hitting submit that I am responsible for payment. <br>
        If I do not cancel class 96 hours in advance I will be charged for my balance, if any.
    </div>

    <div class="button-row">
        <button type="submit" class="button">
            Sign Up For Class
        </button>
    </div>
</form>


@push('footer-inline-scripts')
    <script type="text/javascript">
        const calendarParams = {
            "ajaxUrl": "{{ route('calendar.appointments.ajax', ['event'=> '#event#', 'period' => '#period#']) }}"
        }
    </script>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                const $eventDropdown = $('select[name="booking[event_id]')
                const $appointmentDropdown = $('select[name="booking[appointment_id]');
                if ($('#home-class-sign-up').length) {
                    $('#home-class-sign-up').submit(function (){
                        if ($eventDropdown.val() < 1 || $appointmentDropdown.val() < 1) {
                            alert('Please select Course and Date and Time');
                            return false;
                        }
                        $(this).attr('action', $(this).attr('action').replace('#appointment_id#', $appointmentDropdown.val()))
                        return true;
                    });
                }
                if ($eventDropdown.length > 0) {
                    $eventDropdown.change(function() {
                        const eventId = $( this ).val();
                        $appointmentDropdown.html('<option value="-1">Select</option>')
                        if (eventId>0) {
                            getAppointments(eventId).then(
                                ( res ) => {
                                    if (Array.isArray(res)) {
                                        if (res.length == 0) {
                                            res.unshift({id:-2, date_time_formatted: "No available appointments"});
                                        }
                                        $appointmentDropdown.append(res.map(item => {
                                            return $('<option value="' + item.id + '">' + item.date_time + '</option>')
                                        }))
                                    }
                                },
                                ( err ) => {
                                    console.log(err)
                                }
                            )
                        }
                    });
                }
            });
        })(jQuery)
    </script>
@endpush
@push('footer-scripts')
    <script src="/js/calendar.js" type="text/javascript"> </script>
@endpush
