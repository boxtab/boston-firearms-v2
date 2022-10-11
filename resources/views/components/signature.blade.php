<div class="form-group">
@if(!empty($signaturePath))
<img src="{{url($signaturePath)}}"
     alt="The instructors signature has not been uploaded"
     width="200"
     style="display: block; margin-left: auto; margin-right: auto;"
>
@else
    No signature file found
@endif
</div>
