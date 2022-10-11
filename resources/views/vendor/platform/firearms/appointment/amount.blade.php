<div class="form-group row row-cols-sm-2">
    <label for="field-appointment-1-amount" class="col-sm-2 text-wrap mt-2 form-label">
        Amount
        <sup class="text-danger">*</sup>
    </label>
    <div class="field-block">
        <div
            data-input-mask="{&quot;alias&quot;:&quot;currency&quot;,&quot;prefix&quot;:&quot; &quot;,&quot;groupSeparator&quot;:&quot; &quot;,&quot;digitsOptional&quot;:true}"
        >
            <input class="form-control appointment-amount"
                   name="appointments[appointment1][amount]"
                   type="number"
                   mask="{&quot;alias&quot;:&quot;currency&quot;,&quot;prefix&quot;:&quot; &quot;,&quot;groupSeparator&quot;:&quot; &quot;,&quot;digitsOptional&quot;:true}"
                   value="{{$eventPrice}}" min="0.00" step="0.01" required="required" title="Amount"
                   id="field-appointment-1-amount">
        </div>
    </div>
</div>
