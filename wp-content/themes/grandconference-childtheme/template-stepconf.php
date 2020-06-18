<?php
/*
Template Name: StepConference Template
*/
get_header();

?>
<section class="blog">
<!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
<?php
if (have_posts()) :
   while (have_posts()) :
      the_post();
  ?>
        <div><h1><?php the_title() ?></h1><br/>
          <h2><?php the_date() ?> by <span class="author"><?php the_author(); ?> </span></h2>
        </div>

        <!-- Blog Post -->
        <div class="card mb-4">
        <?php 
            if(get_the_post_thumbnail_url(get_the_ID(), 'large')) :
                ?>
          <img class="card-img-top" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title() ?>">
          <?php endif; ?>
          <div class="card-body">
            <p class="card-text"><?= the_content() ?></p>
          </div>
        </div>
<?php        
endwhile;
endif;

?>
        
       
       

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        	&nbsp;
      </div>
    </div>

       

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
</section>
<?php
get_footer();
?>

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
    </script>
  </body>
</html>
