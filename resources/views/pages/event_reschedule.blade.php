@extends('layout.class')

@section('title', __('Event details'))

@section('page_wrapper_class', 'page-classes')

@section('class-top-section')

    <div class="class-top-section">
        <div class="desktop-wide-wrap">
            <div class="class-top-section-grid">
                <div class="round-desktop"></div>
                <div class="text-block">
                    <div class="title" id="booking-hash" data-bookingHash="{{$bookingHash}}">
                        You Are Currently Scheduled For:
                    </div>
                    <div class="title" id="course-title" data-eventid="{{$selectedEventId}}">
                        {{ $courseTitle }}
                    </div>
                    <div class="title" id="course-date-time" data-appointmentid="{{$selectedAppointmentId}}">
                        {{ $courseDateTime }}
                    </div>
                    <div class="description">
                        Use the dropdown below and calendar to change your reservation.
                    </div>
                    <select name="type" id="drop-down-events" class="life-fire">
                        @foreach ($dropDownEvents as $event)

                            @if ($event->id == $selectedEventId)
                                <option value="{{ $event->id }}" selected>{{ $event->title }}</option>
                            @else
                                <option value="{{ $event->id }}"> {{ $event->title }}</option>
                            @endif

                        @endforeach
                    </select>
                </div>
                @include('includes.classes.partials.class-calendar')
            </div>
        </div>
    </div>

@stop

@push('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" type="text/css"/>
@endpush

@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="/js/common.js" type="text/javascript"></script>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $('#drop-down-events').on('change', function() {

                    $('#course-title')
                        .html($(this).find(":selected").text())
                        .attr('data-eventid', $(this).val());

                    $('#course-date-time').attr('data-appointmentid', "");
                });

                $("#reserve-spot").click(function() {
                    let appointmentId = $('#course-date-time').attr('data-appointmentid');
                    if (String(appointmentId) === "") {
                        return null;
                    }
                    let bookingHash = $('#booking-hash').attr('data-bookingHash');

                    $.ajax({
                        method  : "GET",
                        url     : '/event-reschedule/' + bookingHash + '/' + appointmentId,
                        data    : "formData",
                        dataType: 'json',
                        success : function(data) {
                            if ( ! data.success ) {
                                console.error(data.message);
                                return null;
                            }
                            $('a.reserve-my-spot').css({
                                backgroundColor: '#1e3c5c'
                            }).unbind('click');

                            toastr.success(data.message);
                        },
                        error   : function (jqXHR) {
                            console.error(jqXHR.responseText);
                        }
                    });


                });
            });
        })(jQuery);
    </script>
@endpush

@push('footer-inline-scripts')
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                const eventDropdown = $('#drop-down-events');
                const appointmentDropdown = $('#drop-down-appointments');

                if (eventDropdown.length > 0) {
                    eventDropdown.change(function() {
                        const eventId = $( this ).val();
                        appointmentDropdown.html('<option value="-1">Select</option>');
                        if ( eventId > 0 ) {
                            getAppointments(eventId).then(
                                ( res ) => {
                                    if ($('#schedule-calendar--custom').length) {
                                        calendar.setEvents(res)
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
        })(jQuery);
    </script>
@endpush

