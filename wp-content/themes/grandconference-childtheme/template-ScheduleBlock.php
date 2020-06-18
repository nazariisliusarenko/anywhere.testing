<?php
/*
* Template Name: Template Schedule Block
* Template Post Type: post, page
*/
get_header();
 global $post;
 
    $post_slug=$post->post_name;
   // echo $post_slug;exit;
    if($post_slug=="step-money" || $post_slug=="step-x" || $post_slug=="step-start" || $post_slug=="step-digital" || $post_slug=="step-digital") {
        $output = "<style>
        
        .features2 h2 {
         margin-top: 70px;
        }
        
        
        </style>";
        echo $output;
    }
?>
<div class="container">
     <?php
			if(have_posts()) :
   while(have_posts()) :
      the_post();
         the_content();
   endwhile;
endif;

get_footer();
?>
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?= THEMEROOT ?>/app/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?= THEMEROOT ?>/app/js/grid.js"></script> 







    <script>
         ;(function($){
         $("document").ready(function(e){ 
           
           Grid.init();
          // method for more speakers
          $(".morespeakers").on("click",function(e){
            e.preventDefault();
            $.get( "more.html", function( data ) {
                      $( "#og-grid" ).append( data );                     
                    });
          });
           
         });
          
})(jQuery);

(function($) {
  'use strict';

  function selectPerson(el) {
    var person = $(el);
    var container = person.closest('section.people');

    container.addClass('viewing');

    // Remove currently selected
    $('.person').removeClass('selected');
    $('.close-btn button', container).removeClass('tcon-transform');

    // Animate the button
    person.find('.close-btn button').addClass('tcon-transform');

    // Make the person visible
    person.addClass('selected');

    // Load the content into the DIV
    $('.open-entry').hide();
    var wrap = person.closest('.person-wrapper');
    var preview = person.find('.person-preview').clone();

    if (wrap.hasClass('last')) {
      preview.addClass('open-entry')
        .insertAfter(wrap)
        .fadeIn();
    } else {
      preview.addClass('open-entry')
        .insertAfter(wrap.nextAll('.last:first'))
        .fadeIn();
    }

    $('.open-entry .close-btn').click(function(e) {
      e.preventDefault();
      $('.person.selected').trigger('click');
    });

    $.scrollTo(person, 300, {
      offset: {
        top: -44
      }
    });
  }

  function deselect(el) {
    var person = $(el);
    var container = person.closest('section.people');

    // Hide the visible entry
    $('.open-entry').slideUp(300, function() {
      $(this).remove();
    });

    container.removeClass('viewing');
    $('.person').removeClass('selected');
    $('.close-btn button', container).removeClass('tcon-transform');
  }

  $(function() {
    // For resize we need to specify first and last in row
    $(window).on('resize', function() {

      // Do it for each section
      if ($('.people').length > 0) {
        $('.people').each(function() {
          var section = $(this);

          if ($('.person-wrapper').length) {

            // Hide the visible entry
            $('.person.selected').trigger('click');

            // Remove the helper classes
            $('.person-wrapper', section).removeClass('first last');

            // Get starting X
            var startingX = $('.person-wrapper')
              .first()
              .position()
              .left;

            // Assign proper classes
            var peopleWrappers = $('.person-wrapper', section);
            peopleWrappers.each(function(idx) {
              if ($(this).position().left === startingX) {
                $(this).addClass('first').prev().addClass('last');
              }

              if (idx === peopleWrappers.length - 1) {
                $(this).addClass('last');
              }
            });
          }
        });
      }
    });

    $(window).trigger('resize');

    if ($('.people').length > 0) {
      $('.people').each(function() {
        var section = $(this);

        section.on('click', '.person', function(e) {
          e.preventDefault();

          var person = $(e.target).closest('.person');
          if (person.hasClass('selected')) {
            deselect(this);
          } else {
            selectPerson(this);
          }
        });
      });
    }

    // detect speaker in url
    var hash = window.location.hash;
    if (hash) {
      hash = decodeURIComponent(hash.substring(1).toLowerCase());
      if (hash.indexOf('speakers') !== -1) {
        var name = hash.replace('speakers', '').trim();
        $('.person h3:contains(' + name + ')').trigger('click');
      }
    }
  });
  
})(jQuery);

    </script>
<script>

  $('document').ready(function(e){
     // sort fix for the schedule
     function sortDates(a, b)
{
    return new Date(b).getTime() - new Date(a).getTime();
}

var dates = [];
var _old;

$('.schedule-row').each(function(){
    _old = $(this).parent();
    dates.push($(this).data('date'));
});

var sorted = dates.sort(sortDates);
var _new = $('<div id="accordion">').insertBefore(_old);

$.each(sorted,function(i,val){
    $('.schedule-row[data-date="' + val + '"]').prependTo(_new);
});

_old.remove();



    var acc = $("#accordion").accordion();
  });
  
</script>
  
  

    <script src="<?= site_url() ?>/wp-content/themes/grandconference-childtheme/app/js/schedule.js"></script>

<script>
var catid = "all";
var sessionid = "all";
var dayid = "all";
  $("document").ready(function(){
    $(".cattab").find("li").on("click",function(e){
      e.preventDefault();
      $(".cattab").find("li").removeClass("active");
      $(".sessiontab").find("li").removeClass("active");
      $(".daytab").find("li").removeClass("active");
      $(this).addClass("active");
      catid = $(this).find("a").attr("data-catid");
      $(".session-tabs").addClass("show");
      $("div#accordion").addClass("show");
      if(catid=="all") {
         $("#accordion").find(".schedule-row").show();
      }
      else {
        $("#accordion").find(".schedule-row").hide();
        $("#accordion").find("."+catid).show();
      }
    });
    
    $(".sessiontab").find("li").on("click",function(e){
      e.preventDefault();
      $(".sessiontab").find("li").removeClass("active");
      $(".daytab").find("li").removeClass("active");
      $(this).addClass("active");
      sessionid = $(this).find("a").attr("data-sessionid");
      $(".days-tabs").addClass("show");
      if(sessionid=="all") {
        $(".daytab").find("li").show();
            if(catid=="all") {
               $("#accordion").find(".schedule-row").show();
            }
            else {
              $("#accordion").find(".schedule-row").hide();
              $("#accordion").find("."+catid).show();
            }
      }
      else {
         $(".daytab").find("li").hide();
         $(".daytab").find("li").first().show();
          $(".daytab").find("."+sessionid).show();
              $("#accordion").find(".schedule-row").hide();
              $("#accordion").find("."+sessionid).show();
      }
    });
    
    $(".daytab").find("li").on("click",function(e){
      e.preventDefault();
      $(".daytab").find("li").removeClass("active");
      $(this).addClass("active");
      dayid = $(this).find("a").attr("data-day");
      $("div#accordion").addClass("show");
      if(dayid=="all") {
        $("#accordion").find(".schedule-row").show();
        if(sessionid=="all") {
            if(catid=="all") {
               $("#accordion").find(".schedule-row").show();
            }
            else {
              $("#accordion").find(".schedule-row").hide();
              $("#accordion").find("."+catid).show();
            }
      }
      else {
              $("#accordion").find(".schedule-row").hide();
              $("#accordion").find("."+sessionid).show();
      }
      }
      else {
        $("#accordion").find(".schedule-row").hide();
        $("#accordion").find("."+dayid).show();
      }
    });
    
  });
</script>
</div> <!-- /container -->



  </body>
</html>
