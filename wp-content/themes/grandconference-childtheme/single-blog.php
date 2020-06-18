<?php 
get_header();

?>

<style>
.hdr{width: 100%;background: #697da0; margin-top: 123px;display: block;background: linear-gradient(to right, #1DE6C7 0%, #7488AA 100%);}

a.tag-cloud-link {
    margin: 5px !important;
}
.post_circle_thumb {
    padding: 0px 0px 8px 0px !important;
}
.mfont {
  font-family: "Bebas-bold"!important;
}

.mfont1 {
  font-family: "Roboto" !important;font-size:30px;
}

.mfont_size1 {
  font-size: 42px!important;
}
.mfont_size2 {
  font-size: 23px!important;
}
.b-ctr {
  width: 1170px; margin: auto;
}
.w-mg {
  margin-top: 38px !important;
  text-transform: uppercase !important;
  font-family: "Bebas-bold"!important;
}
.w-mg a{color:#000 !important;}
.fn-bold {
  font-weight: bold !important;
}
.fn-dt {
  font-size: 15px!important;
font-weight: 600!important;
}
.btn-primary {
  font-size: 23px !important;
}

.card-taxt {
    line-height: 39px;
}

.bg_img {
	height: 300px;
	overflow: hidden;
	display: block;
}
.bg_img img {
	height: 100%!important;
	width: auto!important;
}
.bg_ptag {
	font-size: 20px !important;
	margin-top: 15px;
	font-weight: 600;
	font-family: "Roboto" !important;
        line-height: 1px !important;
}

 @media only screen and (max-width: 1000px) {
  .b-ctr, .myctr {
    width: 100% !important;
  }
  .mob-font {
    font-size: 48px !important;
  }
}
.s-txt { font-size: 21px;
font-weight: normal;
}

section.blog img{
width:100%;
height:auto;
}

section.blog p, section.blog ul, section.blog li{
font-size:21px !important;
font-weight: normal !important;
}

section.blog h1{
font-size:32px !important;
font-weight:800 !important;
}

section.blog .author{color:#49bbb7 !important;}
.btn-primary{color: #49bbb7 !important;font-size: 2.25em !important;text-transform: uppercase;font-weight: 800;font-family: "bebas-bold", "Helvetica Neue", Helvetica, Arial, sans-serif !important;}

section.blog h2{
font-size:29px !important;
font-weight:800 !important;
}

section.blog h3{
font-size:26px !important;
font-weight:800 !important;
}

.tagcloud > a
{
padding-left: 14px !important;
padding-right: 14px !important;
font-weight: bold;
}
section.blog a{
color: #49bbb7 !important;
font-weight:700;
text-decoration:none !important;
}
.wp-block-image {margin: auto !important; }
.mob-font{font-family: "Bebas-bold" !important;font-size: 32px !important;text-transform: uppercase !important;color: white !important;padding:10px !important;}

 @media only screen and (max-width: 768px) {
.footer-news-txt{padding-left:0px !important;}
.myctr-desk{margin-left:0px !important;}
.mfont {font-family: "Bebas-bold" !important;font-size: 72px !important;text-transform: uppercase !important;color: white !important;padding:10px !important;}
.mfont1 {font-family: "Roboto !important";font-size: 26px !important;color: #000 !important;margin-top: 6px !important;display: block !important;font-weight: 400 !important;}
.main_blog_box{margin-right:0px !important;}
.mob-font{font-family: "Bebas-bold" !important;font-size: 32px !important;text-transform: uppercase !important;color: white !important;padding:10px !important;}

}

.footer-news-txt{font-size: 25px;text-transform: capitalize;color: white; padding-top: 75px;padding-left:90px;}
.myctr-desk{margin-left:0px;}
div#card-body a{ font-weight: normal;font-size: 20px !important;}

</style>

<div class="hdr">
  <div class="myctr" style="width: 1170px;margin: auto; padding-top: 75px; padding-bottom: 75px;">
    <h1 class="mfont" style="font-size: 72px;text-transform: uppercase;color: white; ">STEP NEWS</h1>
    <span class="mfont1" style="font-size: 26px;color: white;margin-top: 6px;display: block;font-weight: 400; "></span>
  </div>  
</div>


<section class="blog" style="margin-top: 0;">
<!-- Page Content -->
  <div class="container b-ctr">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
<?php
if (have_posts()) :
   while (have_posts()) :
      the_post();
  ?>
        <div style="margin-bottom: 18px;margin-top: 18px;"><h1 class="mfont1 mfont_size1"><?php the_title() ?></h1><br/>
          <h2 class="mfont1 mfont_size2"><?php the_date() ?> by <span class="author"><?php the_author(); ?> </span></h2>
        </div>

        <!-- Blog Post -->
        <div class="card mb-4">
        <?php 
            //if(get_the_post_thumbnail_url(get_the_ID(), 'large')) :
                ?>
         <!-- <img class="card-img-top" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title() ?>"> -->
          <?php //endif; ?>
          <div class="card-body s-txt" id="card-body">
            <p class="card-text" style="font-size: 23px;"><?= the_content() ?></p>
          </div>
        </div>
<?php        
endwhile;
endif;

?>
        
       
       

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4" style="position: -webkit-sticky;position: sticky;top: 12vh;">
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


<?php 
$post_args = array( 'post_type' => 'blog', 'posts_per_page' => 3 );
$post_query = new WP_Query( $post_args ); 
?>


<div class="row" style="margin-top: 50px;">
	<div class="container myctr" style="width: 1170px; margin: auto;">
		<h3 class="mfont1" style="color: #1de6c7">Related articles:</h3>
<?php
if ( $post_query->have_posts() ) : 
while ( $post_query->have_posts() ) : $post_query->the_post(); 
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  

?>

		<div class="col-md-4">
		 	<div class="bg_img">
		 		<img src="<?php echo $url;?>">
		 	</div>
		 	<p class="bg_ptag"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></p>
		</div>
 
       <?php wp_reset_postdata(); ?>
 
<?php endwhile; // ending while loop ?> 
<?php else:  ?>
<p><?php _e( 'Sorry, no Posts.' ); ?></p>
<?php endif; // ending condition ?>



	</div>
</div>



  </div>
  <!-- /.container -->

</section>

<div class="hdr" style="margin-top:0px !important;padding-left:10px;">
<h1 class="mob-font footer-news-txt">Do you have a story you want to share with us?</h1>
  <div class="myctr myctr-desk" style="width: 1170px;padding-top: 75px;padding-bottom: 75px;">
    <div class="action-buttons">
          <a href="mailto:hello@stepconference.com" class="btn" style="margin-top:-55px;">Get in Touch</a>
            </div>
  </div>  
</div>

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
