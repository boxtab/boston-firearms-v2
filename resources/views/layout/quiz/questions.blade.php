<!doctype html>
<html>
<head>
    @include('includes.quiz.head')
</head>

<body>
    @yield('content')
    @stack('footer-styles')
    @stack('footer-inline-styles')
    @stack('footer-scripts')
    @stack('footer-inline-scripts')
</body>
</html>
