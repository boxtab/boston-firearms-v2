<div class="who-for-class">
    <div class="desktop-wide-wrap">
        <div class="who-for-content-flex">
            <div class="who-for-image--mobile">
                <img src="/images/2022/who-for-class--mobile.png" alt="">
            </div>
            <div class="who-for-image--tablet">
                <img src="/images/2022/who-for-class.png" alt="">
            </div>
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
            <div class="who-for-image--desktop">
                <img src="/images/2022/who-for-class--mobile.png" alt="">
            </div>
            <div class="who-for-image--desktop-full">
                <img src="/images/2022/who-for-class.png" alt="">
            </div>
        </div>
    </div>
</div>
