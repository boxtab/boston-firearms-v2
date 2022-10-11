(function ($) {
    $(document).ready(function () {
        if ($('.faq-section').length) {
            $('.faq-section .faq .title').click(function () {
                $('.faq-section .faq .description').slideUp();
                if ($(this).next().css('display') == 'none') {
                    $(this).next().slideDown();
                }
            });
        }


        if ($('.gr-carousel').length) {
            // $('.gr-carousel').slick();
            $('.gr-carousel').slick({
                dots: false,
                // infinite: true,
                infinite: false,
                speed: 300,
                slidesToShow: 3,
                centerMode: true,
                variableWidth: true,
            });
        }

        if ($('.review-carousel').length) {
            $('.review-carousel').slick({
                dots: true,
                // infinite: true,
                infinite: false,
                speed: 300,
                // slidesToShow: 1,
                centerMode: true,
                variableWidth: true,

                responsive: [
                    {
                        breakpoint: 1470,
                        settings: {
                            arrows: true,
                            centerMode: true,
                        },
                    },
                ],
            });
        }
        if ($('.courses-grid').length) {
            $('.courses-grid').slick({
                // dots: true,
                dots: false,
                // infinite: true,
                infinite: false,
                speed: 300,
                slidesToShow: 3,
                centerMode: true,
                // variableWidth: true,
                variableWidth: false,
                // centerPadding: '40px',

                responsive: [
                    {
                        breakpoint: 1023,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            slidesToShow: 1,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            // centerPadding: '40px',
                            // slidesToShow: 2,
                            slidesToShow: 1,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            // centerPadding: '40px',
                            slidesToShow: 1,
                            variableWidth: true,
                            // variableWidth: false,
                        },
                    },
                ],
            });
        }

    });
})(jQuery);
