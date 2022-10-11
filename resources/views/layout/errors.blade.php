@php
$pageName = is_null(Request::segment(1));
@endphp
<!doctype html>
<html>

<head>
    @include('includes.head')
</head>

<body>
    <div class="page page-error page-full-height">
        <div class="hero">
            <div class="desktop-wide-wrap">
                <a href="/" title="Boston firearms" class="logo-01"></a>
            </div>
        </div>
        <div class="page-flat-content">
            <div class="desktop-wide-wrap">
                <div class="container" style="margin-top: 130px">
                    <div class="error-image-block">
                        <img src="/ico/error.png" alt="">
                    </div>

                    <div class="find-out">
                        <strong class="main">
                            @yield('message')
                        </strong>
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-small-fixed">
            <p>
                If you have any questions please call us at
            </p>
            <p>
                <a href="tel:(617) 944-0985">
                    (617) 944-0985
                </a>
            </p>
        </div>
    </div>
    @include('includes.footer.footer_scripts')
    @stack('footer-scripts')
    @stack('footer-inline-scripts')
</body>

</html>