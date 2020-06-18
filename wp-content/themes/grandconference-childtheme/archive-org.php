<?php 
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
            <p class="card-text"><?php the_excerpt() ?></p>
          <div style="height:50px;">&nbsp;</div>
            <a href="<?= get_the_permalink(get_the_ID()) ?>" class="btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
           &nbsp;
          </div>
        </div>
<?php        
endwhile;
endif;

?>
        
       
       

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        	<?php 
						if (is_active_sidebar('single-post-sidebar')) { ?>
		    	    		<ul class="sidebar_widget">
		    	    		<?php dynamic_sidebar('single-post-sidebar'); ?>
		    	    		</ul>
		    	    	<?php } ?>
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
