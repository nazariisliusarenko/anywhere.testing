<!DOCTYPE html>
<!--[if lt IE 7]>      <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
    <head>
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WPWSSS');</script>
<!-- End Google Tag Manager -->


        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php //wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon & Apple Touch Icon -->
        <?php
            $favicon = IMAGES . '/icons/favicon.ico';
            $touchicon = IMAGES . '/icons/apple-touch-icon-precomposed.png';
        ?>

        <link rel="shortcut icon" href="<?php echo $favicon; ?>">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $touchicon; ?>" sizes="152x152">

        <?php wp_head(); ?>
        
         <?php
    if(!isset($_SESSION['screen_width'])):
    ?>
     <script>
        jQuery(function() {
        jQuery.post('<?= THEMEROOT ?>/resolution.php', { width: screen.width, height:screen.height }, function(json) {
        if(json.outcome == 'success') {
            // reload the page to take the correct size.
            location.reload();
        } else {
            //alert('Unable to let PHP know what the screen resolution is!');
        }
    },'json');
});
    </script>
    <?php
    endif;
    ?>

<script>
jQuery(document).ready(function($){
    $(".custom-button-home menu-item menu-item-type-custom menu-item-object-custom").click(function(){
        $("#myModal").modal('show');
    });
});

var ua = window.navigator.userAgent;
var isIE = /MSIE|Trident/.test(ua);

if ( isIE ) {
	jQuery(document).ready(function($){
       $(".togg-vw").on('click',function(){
        var already  = $(this).next().hasClass('active');
        if(already == true){
$(this).next().removeClass('active');
}
else{
         $(this).next().addClass('active');
}
        });
});
}	
</script>
<script src="https://stepconference.com/wp-content/themes/grandconference-childtheme/app/js/polyclip.js"></script>
 

<!-- Global site tag (gtag.js) - Google Ads: 819388617 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-819388617"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-819388617');
</script>

    </head>
<body <?php body_class(); ?> <?php $currentUrl ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
 if($currentUrl=='https://anywhere.stepconference.com/'){ ?> id="homepage" <?php } ?>>
    
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WPWSSS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    
<?php
$tg_topbar = kirki_get_option('tg_topbar');
//echo $tg_topbar; exit;
if($tg_topbar){
require_once('rightnav.php');
}
?>
    <!-- adding navigation from website -->
    <nav class="mobile js-mobile-nav">
        <div class="left">
            <div class="nav-cta">
                <?php

                $logoid = get_post_meta(  get_the_ID(), 'logo', true);
                if($logoid!=null) {
                    $logo = wp_get_attachment_url($logoid);
                }
                else {
                    //$currentUrl ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                   //if($currentUrl=='https://stepconference.com/vw-mobility-challenge/')
                    //{
                      // $logo="https://stepconference.com/wp-content/uploads/2019/10/vw-new.svg";
                    //}
                    //else{
                    $logo = get_stepconference_logo();

                      //}
                }
                ?>
                <a href="/"><img class="logo" src="<?= $logo ?>"></a>
            </div>
        </div>
        <div class="right">
            <div id="mobile-menuToggle">
                <input type="checkbox" id="mobile-checkbox" />
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="tabs-wrapper js-mobile-tabs">
            <?php
                $default = array(
                    'theme_location'  => 'mainmenu',
                    'menu'            => 'mainmenu',
                    'echo'            => true,
                    'depth'           => 0,
                    'walker'          => new mobile_walker
                );
				wp_nav_menu($default);
			?>
            <?php
                $default = array(
                    'theme_location'  => 'rightmenu',
                    'menu'            => 'rightmenu',
                    'echo'            => true,
                    'depth'           => 0,
                    'walker'          => new mobile_walker2
                );
				wp_nav_menu($default);
			?>
        </div>
        <?php
        $currentUrl ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if($currentUrl=='https://stepconference.com/vw-mobility-challenge/')
        {
            $custom="vw-apply";
        } ?>

        <div class="action-buttons">
            <button type="button" class="btn <?php echo $custom;?>" data-toggle="modal" data-target="#myModal">participate</button>
            <a href="https://anywhere.cognitolabs.me/tickets/" class="btn">Tickets</a>
        </div>

    </nav>
    <nav class="desktop colored">
        <div class="left">
    <?php
//$currentUrl ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
    //if($currentUrl=='https://stepconference.com/vw-mobility-challenge/')
    //{
      //$logo="https://stepconference.com/wp-content/uploads/2019/10/vw-new.svg";
    //} ?>


            <a href="/"><img class="logo" src="<?= $logo ?>"></a>
            
             
        <?php
        get_startup_events();
        ?>

        
            </div>
            <div class="right">
                <?php
                    $default = array(
                        'theme_location'  => 'mainmenu',
                        'menu'            => 'mainmenu',
                        'echo'            => true,
                        'depth'           => 0,
                        'walker'          => new description_walker
                        );
                    wp_nav_menu($default);
                ?>
                    

      </div></div></li></ul>
      
      <div class="right">
                <div class="nav-cta">

    <?php
$currentUrl ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
    if($currentUrl=='https://stepconference.com/vw-mobility-challenge/')
    {
      $custom="vw-apply";
    } ?>

          <div class="action-buttons" style="float:right">
              <button type="button" class="btn <?php echo $custom;?>" data-toggle="modal" data-target="#myModal">participate</button>
		<a href="https://anywhere.cognitolabs.me/tickets/" class="btn">Tickets</a>

           <!-- <a href="../step-2019-tickets/" class="btn">tickets</a></div>-->
            </div>
      </div>
      </div>




            <?php
            $default = array(
                'theme_location'  => 'rightmenu',
                'menu'            => 'rightmenu',
                'echo'            => true,
                'depth'           => 0,
                'walker'          => new footer_walker
            );
            $my_menu = wp_get_nav_menu_object( 'rightmenu' );
            if ($my_menu->count > 0) {
                echo '<nav role=\'navigation\' class="burger-navigation"><div id="menuToggle">
    <!--
    A fake / hidden checkbox is used as click reciever,
    so you can use the :checked selector on it.
    -->
    <input type="checkbox" />
    
    <!--
    Some spans to act as a hamburger.
    
    They are acting like a real hamburger,
    not that McDonalds stuff.
    -->
    <span></span>
    <span></span>
    <span></span>
    
    <!--
    Too bad the menu has to be inside of the button
    but hey, it\'s pure CSS magic.
    -->
    <ul id="menu">'?> <?php wp_nav_menu($default); ?><?php echo '
     
    </ul>
  </div></nav>';
            }  ?>




    </nav>
    <!-- end navigation from website -->

    
 