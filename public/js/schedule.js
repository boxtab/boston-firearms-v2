let selectAppointments;

(function ($) {
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($('#home-class-sign-up').length) {
            $('#home-class-sign-up').submit(function (){
                if ($('select[name="booking[event_id]"]').val() < 1 || $('select[name="booking[appointment_id]"]').val() < 1) {
                    alert('Please select Course and Date and Time');
                    return false;
                }
                return true;
            });
        }
        if ($('select[name="booking[event_id]"]').length) {
            $('select[name="booking[event_id]"]').change(function() {
                const eventId = $( this ).val();
                if (eventId) {
                    $.get('/checkout/schedule-event/'+eventId).then(function (res){
                        $('select[name="booking[appointment_id]').html('<option value="-1">Select</option>')
                        if (Array.isArray(res)) {
                            if (res.length == 0) {
                                res.unshift({id:-2, date_time_formatted: "No available appointments"});
                            }
                            $('select[name="booking[appointment_id]').append(res.map(item => {
                                return $('<option value="' + item.id + '">' + item.date_time_formatted + '</option>')
                            }))
                        }
                    });
                }
            });
        }
    });
})(jQuery);
