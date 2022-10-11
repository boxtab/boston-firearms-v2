@extends('layout.page_default')

@section('title', __('Schedule Class'))

@section('page_wrapper_class', 'page-payment page-payment--checkout-schedule')

@section('content')
    @php
        $sessionData = Session::get('checkout')
    @endphp
    @include('includes.checkout.header', ['current' => 'schedule-class'])
    <div class="desktop-wide-wrap">
        <div class="container">
            <form id="class-schedule-form" action="{{ route('checkout.schedule-class.store') }}" method="post">
                @csrf
                <input type="hidden" name="booking[appointment_id]" value="{{ $appointment->id?? -1 }}" id="appointment-id">
                <input type="hidden" name="booking[booking_id]" value="{{ $sessionData['booking_id']?? null }}" >
                <div class="input-title">
                    Pick Your Course
                </div>
                <div class="select-block">
                    <select name="booking[event_id]" id="event-id">
                        <option value="-1">Select</option>
                        @if( ! empty($events) )
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ $event->id == $event_id ? 'selected="selected"':'' }} >{{ $event->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="input-title" id="selected-event-day">
                    @if(! is_null($appointment) )
                        Selected Date: <span>{{ $appointment->date_time_formatted }}</span>
                    @else
                        Select Date and Time
                    @endif
                </div>
                <div class="event-days-calendar-wrap">
                    <div id="event-days-calendar" class="cal1 clndr">
                        <script type="text/template" id="clndr-template">
                            <div class="days-container" style="height: 360px">
                                <div class="controls">
                                    <div class="clndr-previous-button">&lsaquo;</div><div class="month"><%= month %></div><div class="clndr-next-button">&rsaquo;</div>
                                </div>
                                <div class="days">
                                    <div class="headers">
                                        <% _.each(daysOfTheWeek, function(day) { %><div class="day-header"><%= day %></div><% }); %>
                                    </div>
                                    <div class="days-grid">
                                        <% _.each(days, function(day) { %><div class="<%= day.classes %>" id="<%= day.id %>"><%= day.day %></div><% }); %>
                                    </div>
                                </div>
                                <div class="events">
                                    <div class="headers">
                                        <div class="x-button">
                                            <span class="ico close"></span>
                                        </div>
                                        <div class="event-header">EVENTS</div>
                                    </div>
                                    <div class="events-list">
                                    </div>
                                </div>
                            </div>
                        </script>
                    </div>
                </div>

                <div class="button-row">
                    <button class="button" style="border: none">
                        Next
                    </button>
                </div>

            </form>
        </div>
    </div>


@stop

@push('footer-inline-scripts')
    <script type="text/javascript">
        const calendarParams = {
            "ajaxUrl": "{{ route('calendar.appointments.ajax', ['event'=> '#event#', 'period' => '#period#']) }}",
            "appointments": {!! json_encode($appointments) !!},
            "calendarTemplate": "#clndr-template",
            "onDayClick": function (events, element) {
                const calendarContainer = $('#event-days-calendar');
                const eventsEl = $(element).parent().parent().next('.events').find('.events-list');
                const eventDate = moment(events[0].date).format('MMMM Do [(]ddd[)]');
                const selectedDateEl = $('#selected-event-day');
                eventsEl.html($('<div>').text('Date: ' +eventDate));
                const eventDaysEl = $('#appointment-id');
                eventDaysEl.val(-1);
                $(events).each(function (index, event){
                    let eventEl = $('<a>', {id:'event-day-'+event.id})
                        .text(event.title)
                    eventEl.data('event-day-id', event.id)
                    eventEl.click(function(){
                        eventDaysEl.val($(this).data('event-day-id'))
                        selectedDateEl.html("Selected Date: <span>" + event.date_time + "</span>");
                        calendarContainer.find('.days-container').toggleClass('show-events', false)
                    });
                    eventsEl.append(eventEl);
                    eventEl.append($('<br>'));
                });

                calendarContainer.find('.days-container').toggleClass('show-events', true)

                calendarContainer.find('.x-button').click( function() {
                    calendarContainer.find('.days-container').toggleClass('show-events', false)
                });
            }
        }
    </script>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                const $eventDropdown = $('select[name="booking[event_id]')
                const $appointmentId = $('input[name="booking[appointment_id]')
                const $scheduleForm = $('#class-schedule-form');
                if ($eventDropdown.length > 0) {
                    $eventDropdown.change(function() {
                        const eventId = $( this ).val();
                        if (eventId > 0) {
                            getAppointments(eventId).then(
                                ( res ) => {
                                    if ($('#event-days-calendar.clndr').length) {
                                        calendar.setEvents(res)
                                    }
                                },
                                ( err ) => {
                                    console.log(err)
                                }
                            )
                        }
                    })
                }
                if ($scheduleForm.length > 0) {
                    $scheduleForm.submit(function (){
                        if ($eventDropdown.val() <= 0 || $appointmentId.val() <= 0) {
                            alert('Please select Course and Date and Time')
                            return false
                        }
                        return true
                    });
                }
            })
        })(jQuery);
    </script>
@endpush
@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.4/underscore-min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clndr/1.2.16/clndr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/calendar.js" type="text/javascript"> </script>
@endpush
