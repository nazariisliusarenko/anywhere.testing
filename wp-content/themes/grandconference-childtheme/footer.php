      <!-- adding the footer section -->
      <?php $logo = get_stepconference_logo(); ?>
      <section class="footer"><div class="centered1200">
        <div class="row">
          <div class="col-sm-12 col-md-4 footer-1">
              <div class="top">
                  <div class="footer-logo">
                      <a href="/"><img class="footer-logo" src="<?= $logo ?>"></a>
                  </div>
                  <div class="comming-events">

                      <?php
                      get_startup_events();
                      ?>

                      <!-- <div class="event">
                       <p class="date">February 2019
                       <span>Saudi</span>
                       </p>
                     </div> -->

                  </div>
              </div>
           <div class="bottom">
               <div class="social-media">
                   <ul>
                       <?php
                       $default = array(
                           'theme_location'  => 'socialmedia',
                           'menu'            => 'socialmedia',
                           'echo'            => true,
                           'depth'           => 0,
                           'walker'          => new socialmedia_walker
                       );
                       wp_nav_menu($default);
                       ?>


                   </ul>
               </div>
               <?php
               $tg_footer_copyright_text = kirki_get_option('tg_footer_copyright_text');
               if(!empty($tg_footer_copyright_text)):
                   ?>
                   <div class="contact-email">
                       <h3><a href="mailto:<?= $tg_footer_copyright_text ?>"><?= $tg_footer_copyright_text ?></a></h3>
                   </div>
               <?php
               endif;
               ?>
           </div>

          </div>
      
          <div class="col-sm-12 col-md-4 footer-2">
      
            <ul class="footer-nav">
              
               <?php
                    $default = array(
    'theme_location'  => 'footer-menu',
    'menu'            => 'footermenu',
    'echo'            => true,
    'depth'           => 0,
    'walker'          => new footer_walker
    );
				wp_nav_menu($default);
			?>

      
          </div>
      
          <div class="col-sm-12 col-md-4 footer-3">
            <h3>Newsletter</h3>
            <p class="newsletter-title"><span>Don’t miss a thing!</span> <span>Sign up to receive daily news</span></p>
            <?= do_shortcode('[gravityform id="31" title="false" description="false"]') ?>
            <div class="action-buttons">
              <button type="button" class="btn" data-toggle="modal" data-target="#myModal">participate</button>
               <a href="./step-2019-tickets/"  style="display:none;" class="btn">Tickets</a>
            </div>
      
          </div>
      
        </div>
      </section>
      <section class="footer-copyright">
          <div class="centered1200">
              <div class="row">
                  <div class="col-sm-12"><p class="copyright">COPYRIGHT © 2020 STEPCONFERENCE.com</p></div>
              </div>
          </div>
       </section>
      <!-- end footer section -->
      
     
      

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">

    
      <!-- Modal content-->
      <div class="modal-content"><header class="header">
        <div class="logo"><a href="/"><img class="logo" src="<?= get_stepconference_logo() ?>"></a></div><h2 class="title">Participate</h2>
        <div class="close"><button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="background-color:transparent"><i class="fa fa-fw fa-close"></i></button></div></header><div class="boxed pt-50 pb-50">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 text-center">
                <ul class="mt-30 green">
                  
                   <?php
                    $default = array(
    'theme_location'  => 'participate-menu',
    'menu'            => 'participatemenu',
    'echo'            => true,
    'depth'           => 0,
    'walker'          => new footer_walker
    );
				wp_nav_menu($default);
			?>
            
                  
                  
                  </ul></div></div></div></div></div>
      

  </div>
  

  </div></section> 

<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/4ac1154cb94ad33ee1b3d7499/931e8b2e44d7c1f6c828a50ba.js");</script>  
  
<?php
  wp_footer()
  ?>