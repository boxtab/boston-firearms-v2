<div class="who-for">
    <div class="desktop-wide-wrap">
        <div class="who-for-content-flex">
            <div class="who-for-content">

                <div class="title">
                    Who Is This Class For?
                </div>
                @empty(!$class->who_class_for)
                @foreach($class->who_class_for as $value)
                    <div class="for">{{ $value }}</div>
                @endforeach
                @endempty

            </div>
        </div>
    </div>
</div>
