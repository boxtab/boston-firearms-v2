<div class="menu-mobile-opener"></div>
<div class="menu-mobile">
    <div class="menu-mobile-close"></div>
    <div class="menu-mobile-wrap">
        <div class="menu-mobile-fader"></div>
        <div class="menu-col">
            {{--<a href="{{ route('lane-reservation') }}" class="{{request()->routeIs('lane-reservation') ? 'active' : '' }}">
                LANE RESERVATION
            </a>--}}
            <!-- <a href="{{ route('gift-cards') }}" class="{{request()->routeIs('gift-cards') ? 'active' : '' }}">
                GIFT CARDS
            </a> -->
            {{--<a href="https://squareup.com/gift/CE67FY2BTQA33/order" target="_blank" class="{{request()->routeIs('gift-cards') ? 'active' : '' }}">
                GIFT CARDS
            </a>--}}
            {{--<a href="{{ route('contact-us') }}" class="{{request()->routeIs('contact-us') ? 'active' : '' }}">
                CONTACT US
            </a>--}}
             <a href="{{ route('quiz.start') }}" class=" {{request()->routeIs('quiz.start') ? 'active' : '' }}">Do I Qualify?</a>
             <a href="{{ route('quiz.first') }}" class=" {{request()->routeIs('quiz.first') ? 'active' : '' }}">How It Works</a>
             <a href="{{ route('classes') }}" class="button {{request()->routeIs('classes') ? 'active' : '' }}">Classes</a>
        </div>
    </div>
</div>
