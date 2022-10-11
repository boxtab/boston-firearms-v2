<div class="row form-group align-items-baseline">

    <div class="col-auto pe-md-0">
        <div class="form-group row row-cols-sm-2">
            <div class="field-block">
                <div data-controller="datetime"
                     class="input-group"
                     data-datetime-enable-time="true"
                     data-datetime-time-24hr="false"
                     data-datetime-allow-input="true"
                     data-datetime-date-format="h:i K"
                     data-datetime-no-calendar="true"
                     data-datetime-minute-increment="5"
                     data-datetime-hour-increment="1"
                     data-datetime-static="false"
                     data-datetime-disable-mobile="false"
                     data-datetime-inline="false"
                     data-datetime-position="auto auto"
                     data-datetime-shorthand-current-month="false"
                     data-datetime-show-months="1">
                    <input type="text"
                           placeholder="From"
                           class="form-control flatpickr-input appointment-from"
                           data-datetime-enable-time="true"
                           data-datetime-time-24hr="false"
                           data-datetime-allow-input="true"
                           data-datetime-date-format="h:i K"
                           data-datetime-no-calendar="true"
                           data-datetime-minute-increment="5"
                           data-datetime-hour-increment="1"
                           data-datetime-static="false"
                           data-datetime-disable-mobile="false"
                           data-datetime-inline="false"
                           data-datetime-position="auto auto"
                           data-datetime-shorthand-current-month="false"
                           data-datetime-show-months="1"
                           name="appointments[appointment1][start_time]"
                           required="required"
                           autocomplete="off"
                           data-datetime-target="instance"
                    >
                </div>
            </div>
        </div>
    </div>

    <div class="col-auto">
        <div class="form-group row row-cols-sm-2">
            <div class="field-block">
                <div data-controller="datetime"
                     class="input-group"
                     data-datetime-enable-time="true"
                     data-datetime-time-24hr="false"
                     data-datetime-allow-input="true"
                     data-datetime-date-format="h:i K"
                     data-datetime-no-calendar="true"
                     data-datetime-minute-increment="5"
                     data-datetime-hour-increment="1"
                     data-datetime-static="false"
                     data-datetime-disable-mobile="false"
                     data-datetime-inline="false"
                     data-datetime-position="auto auto"
                     data-datetime-shorthand-current-month="false"
                     data-datetime-show-months="1">
                    <input type="text"
                           placeholder="To"
                           class="form-control flatpickr-input appointment-to"
                           data-datetime-enable-time="true"
                           data-datetime-time-24hr="false"
                           data-datetime-allow-input="true"
                           data-datetime-date-format="h:i K"
                           data-datetime-no-calendar="true"
                           data-datetime-minute-increment="5"
                           data-datetime-hour-increment="1"
                           data-datetime-static="false"
                           data-datetime-disable-mobile="false"
                           data-datetime-inline="false"
                           data-datetime-position="auto auto"
                           data-datetime-shorthand-current-month="false"
                           data-datetime-show-months="1"
                           name="appointments[appointment1][end_time]"
                           required="required"
                           autocomplete="off"
                           data-datetime-target="instance">
                </div>
            </div>
        </div>
    </div>

</div>


