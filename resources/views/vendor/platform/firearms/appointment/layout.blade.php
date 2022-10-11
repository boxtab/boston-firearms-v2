<div class="container-appointment">
    <div class="entry-appointment" id="entry1">
        <fieldset class="mb-3">
            <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column admin--filters">

                @include('vendor.platform.firearms.appointment.start-end-time')
                @include('vendor.platform.firearms.appointment.spots')
                @include('vendor.platform.firearms.appointment.amount')
                @include('vendor.platform.firearms.appointment.payment-type')
                @include('vendor.platform.firearms.appointment.has-live-fire')

                <span class="input-group-btn">
                    <button class="btn btn-success btn-add-appointment enableOnInput" type="button">
                        <span>Add</span>
                    </button>
                </span>

            </div>
        </fieldset>
    </div>
</div>


