@php
$pageName = is_null(Request::segment(1));
@endphp
<!doctype html>
<html>

<head>
    @include('includes.head')
</head>

<body>
    <div class="@yield('page_wrapper_class')">
        @include('includes.header.header-transparent', ['isHome' => $pageName])

        @yield('content')

        @include('includes.footer.footer')
    </div>
    @include('includes.footer.footer_scripts')
    @stack('footer-scripts')
    @stack('footer-inline-scripts')
</body>

</html>
