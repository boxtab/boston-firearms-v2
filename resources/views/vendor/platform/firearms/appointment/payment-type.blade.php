<div class="form-group row row-cols-sm-2">
    <label for="field-appointment-1-payment-type" class="col-sm-2 text-wrap mt-2 form-label label-appointment-payment-type">
        Payment type
        <sup class="text-danger">*</sup>
    </label>

    <div class="field-block">
        <div>
            <select class="form-control appointment-payment-type"
                    name="appointments[appointment1][payment_type]"
                    required="required"
                    title="Payment type"
                    id="field-appointment-1-payment-type">
                @isset($paymentTypes)
                    @foreach($paymentTypes as $paymentTypeKey => $paymentTypeValue)
                        <option value="{{ $paymentTypeKey }}">
                            {{ $paymentTypeValue }}
                        </option>
                    @endforeach
                @endisset
            </select>
        </div>

    </div>
</div>
