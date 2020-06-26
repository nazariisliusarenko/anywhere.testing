(function($) {
    'use strict';
    $( document ).ready(function() {
        $("#mobile-checkbox").change(function() {
            $('.js-mobile-nav').toggleClass('opened');

            $(this).toggleClass('active');
            $('.js-mobile-tabs').toggleClass('active');
        });
        var videoHeight = 785;
        if ($(window).width() < 990) {
            videoHeight = 881;
        } else if ($(window).width() < 768) {
            videoHeight = 618;
        }

        $(window).on('scroll', function() {
            if ($(window).scrollTop() >= $(
                '.countdown').offset().top + $('.countdown').
            outerHeight() - window.innerHeight + 785) {

                $('.countdown').addClass('stick');
            }
        });
        $(window).scroll(function () {
            if ($(this).scrollTop()  <= 0 ){
                $('.countdown').removeClass('stick');
            }
        });



        window.onscroll = function(ev) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                $('.countdown').addClass('hidden');
            } else {
                $('.countdown').removeClass('hidden');
            }
        };
        // $('.speakers ul li').each((index, e) => {
        //     console.log('e', e);
        //     var height = e.find('.og-expander').height();
        //     console.log('height', height);
        //     e.find('.og-expander').height(height);
        // })

    });
})(jQuery);



