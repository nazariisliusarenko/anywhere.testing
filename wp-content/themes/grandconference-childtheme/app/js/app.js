(function($) {
    'use strict';
    var lastScrollTop = 0;
  
    $(window).scroll(function() {
      var scrollTop = $(window).scrollTop();
  
      if (scrollTop >= 40) {
          $('nav.desktop, nav.mobile').addClass('colored');
  
      } else {
        $('nav.desktop, nav.mobile').removeClass('colored');
      }
  
      // hide show scroll
      if (scrollTop > lastScrollTop && scrollTop >= 500){
        // scrolling down
        $('nav.desktop, nav.mobile').addClass('nav-hidden');
      } else {
        // scrolling up
        $('nav.desktop, nav.mobile').removeClass('nav-hidden');
      }
  
      lastScrollTop = scrollTop;
    });
  })(jQuery);
// Clean up the url for backend validation
function sanitizeUrl(url) {
    var filename = url.substring(url.lastIndexOf('/') + 1);
    return url.replace(filename, encodeURIComponent(filename));
  }
  
  // Generate a unique id to group the images
  function makeid(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  
    for( var i=0; i < length; i++ )
      text += possible.charAt(Math.floor(Math.random() * possible.length));
  
    return text;
  }
  
  function handleUploadError(err, el) {
    try {
      console.log(err);
    } catch(e) {}
  };
  
  (function($) {
    'use strict';
  
    //moment.tz.setDefault('Asia/Dubai');
  
    // redirect womensday page to home page
    if(window.location.pathname.includes('womensday')) {
      window.location.href= window.location.protocol + "//" + window.location.host + "/"
    }
  
    // Lazy load images to avoid loading the page all at once
    //$('.lazy').lazyload();
    //$('.lazy-fade').lazyload({ effect: 'fadeIn' });
  
    // TODOUpdateDate: Disable the dates as of now
    // var countdownDate = CONFERENCE_YEAR + '/04/03';
    // $('.header-time').countdown('2018/03/28', function(event) {
    //   if (!event.elapsed) {
    //     $(this).html(event.strftime('%D Days:%H:%M:%S'));
    //   } else {
    //     $(this).hide();
    //     $('body').addClass('no-header-time');
    //   }
    // });
  
    var elements = $('[data-countdown-timer]');
    if(elements.length); {
      elements.each(function(index, element) {
        var date = $(element).attr('data-countdown-timer');
        var message = $(element).attr('data-countdown-message') || '';
        setTimer(new Date(date).getTime(), message);
      });
    }
  
    // var countDownDate = new Date(2018, 1, 1).getTime();
  
    function setTimer(countDownDate, message) {
      setInterval(function () {
        // Get todays date and time
        var now = new Date().getTime();
  
        // Find the distance between now an the count down date
        var distance = countDownDate - now;
  
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
        $('.countdown-timer').text(message + ' ' + days + ' days, ' + hours + ' hours, '
        + minutes + ' minutes');
  
        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            $('.countdown-timer').text('IT HAPPENED');
        }
      }, 1000);
    }
  
    // Initialize the variables
    window.USER = window.USER || null;
  
    var disposableDomains = [
      'mailinator',
      '33mail',
      'guerrillamail',
      'fakeinbox'
    ];
  
    // Add a validator for disposable emails
    /*$.validator.addMethod("noDisposableEmail", function(value, element) {
      var regex = new RegExp(disposableDomains.join('|'), 'i');
      return ! regex.test(value);
    }, "Disposable emails are not allowed.");
  
    // Add a case-insensitive search for :contains
    $.expr[':'].contains = $.expr.createPseudo(function(arg) {
      return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
      };
    });
  */
    // Add request headers if user exists and is logged in
    if (USER) {
      $.ajaxSetup({
        beforeSend: function(xhr) {
          xhr.setRequestHeader('Authorization', 'Bearer ' + Cookies.get('_step_user'));
        }
      });
    }
  
    // Lets add a plugin for selecting proper URL variables
    $.extend({
      getUrlVars: function(){
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
        }
        return vars;
      },
      getUrlVar: function(name){
        return $.getUrlVars()[name];
      }
    });
  
    $(function() {
      if(window.mobile) {
        // video banners
        $('[data-vide-bg]').each(function(index, element) {
          $(element).children(':first').remove();
          $(element).addClass('mobile-banner-img img-responsive');
        });
  
        // show images on mobile
        var elements = $('[data-mobile-img]');
        if(elements.length); {
          elements.each(function(index, element) {
            var src = $(element).attr('data-mobile-img');
            $(element).find('.section-container, .info').prepend('<div class="img-mobile">' +
            '<img class="img-responsive" src="' + src + '" />' +
            '</div>');
          });
        }
  
        var elements = $('[data-mobile-video]');
        if(elements.length); {
          elements.each(function(index, element) {
            var src = $(element).attr('data-mobile-video');
            $(element).find('.info').prepend(
              '<div class="video-img-wrapper"><embed width="100%" height="100%" src="' + src + '" /></div>'
            );
          });
        }
      }
  
      // Slider fun
      var sliders = $('section.quotes .slider');
      if (sliders.length) {
        sliders.each(function(idx, slider) {
          slider = $(slider).bxSlider({
            pause: 4000,
            auto: true,
            adaptiveHeight: window.mobile
          });
  
          // Next slide
          slider.find('.next-slide').click(function(e) {
            e.preventDefault();
            slider.goToNextSlide();
          });
        });
      }
  
      // Update selected navigation item
      var url = window.location.href;
      if (url.indexOf('/conference') !== -1) {
        $('#nav-item-conference').addClass('active');
      }
      if (url.indexOf('/music') !== -1) {
        $('#nav-item-music').addClass('active');
      }
      if (url.indexOf('/news') !== -1) {
        $('#nav-item-news').addClass('active');
      }
  
     /* $('.news .parallax').parallax({
        naturalWidth: 625,
        naturalHeight: 395
      });
  */
  
      /*$("#nav-site").sticky({
        zIndex: 1000
      }).on('sticky-start', function() {
        $('.nav-sections').addClass('push-bottom');
        // Copy the main menu to the submenu
        var logoMenu = $('#nav-step').clone().attr('id', null);
        $('#nav-logo-popout').html(logoMenu);
      });
  
      $("#nav-site").sticky({
        zIndex: 1000
      }).on('sticky-end', function() {
        $('.nav-sections').removeClass('push-bottom');
      });
  
      /**
       * Modal functionality
       */
      $('.js-participate-modal').click(function(e) {
        e.preventDefault();
        showParticipateModal();
      });
  
      $('.js-participate-modal-close').click(function(e) {
        e.preventDefault();
        closeParticipateModal();
      });
  
      // if clicked outside, close the modal-close
      $('#participate-modal-menu').click(function(e) {
        if (e.target !== e.currentTarget) return;
  
        closeParticipateModal();
      });
  
      function closeParticipateModal() {
        $('#participate-modal-menu').removeClass('opened');
      }
  
      function showParticipateModal() {
        $('#participate-modal-menu').addClass('opened');
      }
  
      /**
       * Closes mobile popup
       */
      $('.js-nav-toggle').click(function(e) {
        e.preventDefault();
        $('.js-mobile-nav').toggleClass('opened');
  
        $(this).toggleClass('active');
        $('.js-mobile-tabs').toggleClass('active');
      });
  
      $('.js-mobile-submenu-item').click(function(e) {
        $(this).toggleClass('opened');
  
        if($(this).hasClass('opened')) {
          $(this).children().find('submenu').slideUp();
        }
      });
  
      $('form.attend').on('submit', function(e) {
          e.preventDefault();
  
          var form = $(this);
  
          var formData = {
            firstName: form.find('input#firstName').val(),
            lastName: form.find('input#lastName').val(),
            email: form.find('input#email').val(),
            tags: '2018-2for1'
          };
  
          $.ajax({
            dataType: 'json',
            method: 'POST',
            // url: 'http://localhost:4000/subscribe',
            url: 'https://api.stepconference.com/subscribe',
            data: formData,
            success: function(res) {
              console.log(res);
              setTimeout(function() {
                document.location.href = 'attend/thank-you';
              }, 500);
  
            },
            error: function(res) {
              var message = res.responseJSON.message;
  
              if (message) {
                $('.error-message').text(message);
                $('.error.message').show();
              }
            }
          });
        });
    });
    
      $(function(){
  
$('.ticketsfilter').find('li').on('click',function(e){
  var className = $(this).find('a').attr('data-val');
  if(className == "alltickets") {
    $('.tickets').find('li').show();
  }
  else {
     $('.tickets').find('li').hide();
   $('.tickets').find('li.'+className).show();
  }
  
});

$('.partnersfilter').find('li').on('click',function(e){
  var className = $(this).find('a').attr('data-val');
  if(className == "allpartners") {
    $('.allpartners').find('.item-width').show();
  }
  else {
     $('.allpartners').find('.item-width').hide();
   $('.allpartners').find('.'+className).show();
  }
  
});
  
})

  })(jQuery);
  
