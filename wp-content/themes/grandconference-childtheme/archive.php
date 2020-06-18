<?php 
get_header();

?>

<style>
.hdr{width: 100%;background: #fff; background-image: none;background: linear-gradient(to right, #1DE6C7 0%, #7488AA 100%); margin-top: 123px;display: block;}
.myctr{width: 1170px;width: 1170px;margin: auto; padding-top: 75px; padding-bottom: 75px;}

.mfont {font-family: "Bebas-bold";font-size: 72px;text-transform: uppercase;color: white;}
.mfont1 {font-family: "Roboto !important";font-size: 26px;color: white;margin-top: 6px;display: block;font-weight: 400;}
a.tag-cloud-link {margin: 5px !important;}
.post_circle_thumb {padding: 0px 0px 8px 0px !important;}
.bl-h1{font-size: 37px !important;font-family: "Roboto" !important;line-height:55px !important;color: black !important;font-weight: 700;text-decoration: none !important;}
.b1-h1-a a:hover{color:white !important;}
.bl-h2{font-size: 22px !important;}

.b-ctr {
  width: 1170px; margin: auto;
}

.card-img-top
{
width:675px !important;
height:544px !important;
margin:auto !important;
display:block;
}

@media only screen and (max-width: 1000px) {
  .b-ctr, .myctr {
    width: 100% !important;
  }

  .card-img-top{
  width: 100% !important;
  height:100% !important;
  }

}


.tagcloud > a{
font-weight: bold;font-weight: bold;font-size: 15px;padding-left: 14px !important;padding-right: 14px !important;

}

.w-mg {
  margin-top: 38px !important;
  text-transform: uppercase !important;
  font-family: "Bebas-bold"!important;
}
.main_blog_box {
  box-shadow: 3px 2px 9px #ddd;
  padding: 15px;margin-right:20px;
}

.main_blog_box a:focus, a:hover {
    text-decoration: none !important;
}
section.blog .author{color:#49bbb7 !important;}
.btn-primary{color: #49bbb7 !important;font-size: 2.25em !important;text-transform: uppercase;font-weight: 800;font-family: "bebas-bold", "Helvetica Neue", Helvetica, Arial, sans-serif !important;}
section.blog a{
color: #49bbb7 !important; font-weight: 700;
}
.mob-font{font-family: "Bebas-bold" !important;font-size: 32px !important;text-transform: uppercase !important;color: white !important;padding:10px !important;}

 @media only screen and (max-width: 768px) {
.footer-news-txt{padding-left:0px !important;}
.myctr-desk{margin-left:0px !important;}
.mfont {font-family: "Bebas-bold" !important;font-size: 72px !important;text-transform: uppercase !important;color: white !important;padding:10px !important;}
.mfont1 {font-family: "Roboto !important";font-size: 26px !important;color: white !important;margin-top: 6px !important;display: block !important;font-weight: 400 !important;}
.mob-font{font-family: "Bebas-bold" !important;font-size: 32px !important;text-transform: uppercase !important;color: white !important;padding:10px !important;}
.main_blog_box{margin-right:0px !important;}
}

.footer-news-txt{font-size: 25px;text-transform: capitalize;color: white; padding-top: 75px;padding-left:90px;}
.myctr-desk{margin-left:88px;}

.footer-page-navigation{background-color:#fff;margin-top: 0px !important;
    padding-left: 169px;
    padding-bottom: 34px;
    font-size: 2.25em !important;
    font-family: "bebas-bold", "Helvetica Neue", Helvetica, Arial, sans-serif !important;

}

.prev page-numbers{color: #49bbb7 !important;}
.page-numbers{color: #49bbb7 !important;}
.next page-numbers{color: #49bbb7 !important;}
.paging ul {
    float:right;
}
.paging ul li {
    float:left;
    margin:0px 0px 2px 0px;
}
.paging ul li a{
    background-color:#fff;
    color:#FFF;
    padding:7px 11px 7px 11px;
    font-size:12px;
    border:solid 2px #000;
    margin-left:1px;
}
.paging ul li .current, .paging ul li .dots  {
    background-color:#FFF;
    color:#000;
    padding:7px 11px 7px 11px;
    font-size:12px;
    border:solid 2px #000;
    margin-left:1px;
}
.paging ul li a:hover {
    background-color:#333;
}
</style>

<div class="hdr">
  <div class="myctr">
    <h1 class="mfont">STEP NEWS</h1>
    <span class="mfont1"></span>
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
        <div class="main_blog_box"> 
          <div style="margin-bottom: 18px;margin-top: 18px;">
            <a href="<?= get_the_permalink(get_the_ID()) ?>" class="b1-h1-a"><h1 class="bl-h1"><?php the_title() ?></h1></a>
            <h2 class="bl-h2"><?php the_date() ?> by <span class="author"><?php the_author(); ?> </span></h2>
          </div>

        <?php $url = get_permalink(get_the_ID());?> 
        <!-- Blog Post -->
        <div class="card mb-4">
            <?php 
            if(get_the_post_thumbnail_url(get_the_ID(), 'large')) :
                ?>
          <img class="card-img-top" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title() ?>" onClick="parent.location='<?php echo $url;?>'">
          <?php endif; ?>
          <div class="card-body">
           <a href="<?= get_the_permalink(get_the_ID()) ?>" style="color: black !important;text-decoration: none !important;"> <p class="card-text" style="font-size: 23px;"><?php the_excerpt() ?></p></a>
            <a href="<?= get_the_permalink(get_the_ID()) ?>" class="btn-primary">Read More &rarr;</a>
          </div>
        </div>
       
      </div>
          <div class="card-footer text-muted" style="margin-top:24px;margin-bottom:4px;">
           &nbsp;
          </div>


<?php        
endwhile;
endif;

?>
        
       
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4" style="position: -webkit-sticky;position: sticky;top: 12vh;padding:0;">

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

<div class="footer-page-navigation">
<?php echo paginate_links( $args ) ?>
</div>

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
