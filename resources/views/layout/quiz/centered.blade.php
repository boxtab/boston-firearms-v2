<!doctype html>
<html>

<head>
    @include('includes.quiz.head')
</head>

<body>
    <div class="page @yield('page_wrapper_class')">
        <div class="desktop-wide-wrap">
            @yield('header')
            @yield('content')

        @yield('footer')
        </div>
    </div>

    @stack('footer-styles')
    @stack('footer-inline-styles')
    @stack('footer-scripts')
    @stack('footer-inline-scripts')
</body>

</html>
