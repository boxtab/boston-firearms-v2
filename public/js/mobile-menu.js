(function ($) {
    $(document).ready(function () {
        if ($('#mobile-menu').length) {
            $('.mobile-menu-opener').click(function () {
                $('#mobile-menu').toggle();
            });
            $('.mobile-menu-closer').click(function () {
                $('#mobile-menu').toggle();
            });
        }
    });
    $(document).ready(function () {
        if ($('.menu-mobile').length) {
            $('.menu-mobile-opener').click(function () {
                $('.menu-mobile').toggle();
                $('.menu-mobile-opener').toggle();
            });
            $('.menu-mobile-close').click(function () {
                $('.menu-mobile').toggle();
                $('.menu-mobile-opener').toggle();
            });
        }
    });
})(jQuery);
