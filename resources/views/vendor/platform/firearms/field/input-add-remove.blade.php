@component($typeForm, get_defined_vars())
    <div data-controller="input"
         data-input-mask="{{$mask ?? ''}}"
         class="input-add-remove-container"
    >
        <div class="input-group-text">
            <input {{ $attributes }}>
            <div class="input-group-append">
                <button type="button" class="btn btn-link btn-add-row">
                    <x-orchid-icon path="plus" class="me-2"/>
                </button>
            </div>
            <div class="input-group-append">
                <button type="button" class="btn btn-link btn-remove-row">
                    <x-orchid-icon path="minus" class="me-2"/>
                </button>
            </div>
        </div>
    </div>
@endcomponent
