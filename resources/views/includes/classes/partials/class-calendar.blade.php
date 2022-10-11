<div class="class-calendar-block">
    @if($appointments->count() > 0)
        <div class="calendar-row">
            <div class="clndr" id="schedule-calendar--custom">
                <script type="text/template" id="template-calendar-custom">

                    <div class="clndr-controls top cMonth">
                        <div class="p-year"><%= year %></div>
                        <div class="p-month "><%= month %></div>
                        <div class="mNav">
                            <div class="clndr-previous-button a-prev"></div>
                            <div class="clndr-next-button a-next"></div>
                        </div>
                    </div>

                    <div class="tr-select">
                        <div>Select A Date</div>
                    </div>
                    <div class="clndr-grid">
                        <div class="days-of-the-week tr-days">
                            <% _.each(daysOfTheWeek, function(day) { %>
                            <div class="header-day wDays"><%= day %></div>
                            <% }); %>
                        </div>
                        <div class="tr-gap"></div>
                        <div class="days tr-bordered">
                            <% _.each(days, function(day) { %>
                            <div class="<%= day.classes %>">
                                <div><%= day.day %></div>
                                <% if (day.events.length) { %>
                                    @if(empty($isReschedule))
                                        @include('includes.classes.partials.schedule')
                                        @else
                                        @include('includes.classes.partials.reschedule')
                                    @endif
                                <% } %>
                            </div>
                            <% }); %>
                        </div>

                    </div>

                </script>
            </div>
        </div>
        <div class="button-row">
            <a href="#" class="button reserve-my-spot" id="reserve-spot">
                Reserve my spot
            </a>
        </div>
    @else
       <div class="unavailable-row">
         <p>
            This event currently has no available spots
         </p>
       </div>

    @endif

</div>



@push('footer-inline-scripts')
    <script type="text/javascript">
        function setAppointment(appointmentId, rescheduleDateTime) {
            $('#course-date-time').html(rescheduleDateTime).attr('data-appointmentid', appointmentId);
        }
    </script>
    <script type="text/javascript">
        let calendarParams = {
            "ajaxUrl": "{{ route('calendar.appointments.ajax', ['event'=> '#event#', 'period' => '#period#']) }}",
            "appointments": {!! json_encode($appointments) !!},
            "calendarTemplate": "#template-calendar-custom",
            "onDayClick": function (events) {
               // $('#reserve-spot').attr('href', events[0].url)
            }
        }
    </script>
@endpush
@push('footer-scripts')
    <script src="/js/calendar.js" type="text/javascript"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.4/underscore-min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clndr/1.2.16/clndr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

