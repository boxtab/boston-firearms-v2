(function ($) {

    $('.container-appointment').on('click', '.appointment-payment-type', function() {
        let amountDisabled = false;
        if ( Number($(this).find(":selected").val()) === 3 ) {
            amountDisabled = true;
        }
        $(this).closest("fieldset").find('.appointment-amount').prop('disabled', amountDisabled);
    });

    $(document).on('click', '.btn-add-appointment', function(e) {
        e.preventDefault();

        var controlForm = $(this).closest('.container-appointment');//.find('form:first'),
            currentEntry = $(this).parents('.entry-appointment:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm),
            regex = /^(.+?)(\d+)$/i,
            cloneIndex = $(".entry-appointment").length,
            amount = $('input[name="appointments[appointment1][amount]"]').val();

        newEntry.find('div').val('');
        // Change div id
        newEntry.attr("id", "entry" +  cloneIndex);

        // From
        newEntry.find('input.appointment-from').attr('name', 'appointments[appointment' + cloneIndex + '][start_time]');

        // To
        newEntry.find('input.appointment-to').attr('name', 'appointments[appointment' + cloneIndex + '][end_time]');

        // Spots
        newEntry.find('input.appointment-spot').attr('name', 'appointments[appointment' + cloneIndex + '][spots]');

        // Amount
        newEntry.find('input.appointment-amount').attr('name', 'appointments[appointment' + cloneIndex + '][amount]');
        newEntry.find('input.appointment-amount').attr('value', amount);

        // Payment type
        newEntry.find('label.label-appointment-payment-type').attr('for', 'field-appointment-' + cloneIndex + '-payment-type');
        newEntry.find('select.appointment-payment-type').attr('name', 'appointments[appointment' + cloneIndex + '][payment_type]');
        newEntry.find('select.appointment-payment-type').attr('id', 'field-appointment-' + cloneIndex + '-payment-type');

        // Live fire
        newEntry.find('label.label-appointment-has-live-fire').attr('for', 'field-appointment-' + cloneIndex + '-has-live-fire');
        newEntry.find('select.appointment-has-live-fire').attr('name', 'appointments[appointment' + cloneIndex + '][has_live_fire]');
        newEntry.find('select.appointment-payment-type').attr('id', 'field-appointment-' + cloneIndex + '-has-live-fire');


        controlForm.find('.entry-appointment:not(:last) .btn-add-appointment')
            .removeClass('btn-add-appointment').addClass('btn-remove-appointment')
            .removeClass('btn-success').addClass('btn-danger')
            // Not this one
            //.attr("id", "entry" +  cloneIndex)
            .find("*")
            .each(function() {
                var id = this.id || "";
                var match = id.match(regex) || [];
                if (match.length === 3) {
                    this.id = match[1] + (cloneIndex);
                }
            })
            .html('<span>Remove</span>');
    })
    .on('click', '.btn-remove-appointment', function(e) {
        $(this).parents('.entry-appointment:first').remove();

        e.preventDefault();
        return false;
    });

})(jQuery);
