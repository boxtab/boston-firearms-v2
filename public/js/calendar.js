window.calendar = null;
(function ($) {
    $(document).ready(function () {
        if ($('.clndr').length){
            const lastAppointmentDate = calendarParams.appointments.length > 0
                ? calendarParams.appointments[calendarParams.appointments.length-1].date
                : moment().endOf('year');

            window.calendar = $('.clndr').clndr({
                template: $(calendarParams.calendarTemplate).html(),
                constraints: {
                    startDate: moment(),
                    endDate: moment(lastAppointmentDate).format('YYYY-MM-DD')
                },
                ignoreInactiveDaysInSelection: false,
                forceSixRows: true,
                showAdjacentMonths: true,
                trackSelectedDate: false,
                //selectedDate: moment(),
                events: calendarParams.appointments,
                clickEvents:{
                    click: function (target) {
                        if (target.events.length) {
                            calendarParams.onDayClick(target.events, target.element)
                        }
                    }
                }
            });
        }
    });
})(jQuery);

jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function getAppointments(eventId, period)
{
    return new Promise((resolve, reject) => {
        if (!calendarParams.ajaxUrl) {
            reject("Appointments URL is not defined");
        }
        let url = calendarParams.ajaxUrl.replace('#event#', eventId);
        if (typeof period !== "undefined") {
            url = url.replace('#period#', period)
        }
        jQuery.get(url)
            .done((res)=>{
                resolve(res)
            })
            .fail((err) => {
                reject(err)
            })
    });
}
