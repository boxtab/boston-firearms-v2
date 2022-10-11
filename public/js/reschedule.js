(function ($) {
    $(document).on('change', 'select[name="eventId"]', function(e) {
        $.ajax({
            method  : "GET",
            url     : '/calendar/appointments/' + this.value,
            dataType: 'json',
        }).done(function( res ) {
                $('select[name="appointmentId"]')
                    .find('option')
                    .remove()
                    .end()
                    .append(res.map(item => {
                        return $('<option value="' + item.id + '">' + item.date_time + '</option>')
                    }));
        }).fail(function(err, textStatus, errorThrown) {
            console.error(err);
            console.error(textStatus);
            console.error(errorThrown);
        });
    });
})(jQuery);
