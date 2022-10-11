<div class="form-group row row-cols-sm-2">
    <label for="field-appointment-1-has-live-fire" class="col-sm-2 text-wrap mt-2 form-label label-appointment-has-live-fire">
        Live fire
        <sup class="text-danger">*</sup>
    </label>
    <div class="field-block">
        <div>
            <select class="form-control appointment-has-live-fire"
                    name="appointments[appointment1][has_live_fire]"
                    required="required"
                    title="Live fire"
                    id="field-appointment-1-has-live-fire">
                @isset($liveFires)
                    @foreach($liveFires as $liveFireKey => $liveFireValue)
                        <option value="{{ $liveFireKey }}">
                            {{ $liveFireValue }}
                        </option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>
</div>
