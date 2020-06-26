<?php

namespace Gutenberg_Courses\Example_Block\Blocks\banners;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_banners_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_banners_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/banners', [
		'render_callback' => __NAMESPACE__ . '\render_banners_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_banners_block($attributes) {

     $videobg = "mp4: " . $attributes["mp4Url"] . ", webm: " . $attributes["webmUrl"];
     $imgbg = $attributes["imageUrl"];
     if(isset($attributes["imageUrl"])) {
         $output = '<div class="section hero-section" style="height:600px" >
         <div class="beforeVideo">
         <div class="primary-overlay-bottom"></div>
         <div class="bgImage" style="background-image:url('.$imgbg.');background-size:cover;height:100vh">&nbsp;</div>
         </div>
	<div class="section-contents theme-dark">
	
			<section class="techFestivalForm">
			<div class="event mobilev" style="width: 300px;padding: 0;top:12px;position:relative;"><p class="date" style="display: none;">February 13 – 14,2019<span>Riyadh</span></p>
<div class="date" style="">
    <p class=" " style="float: left;font-size: 17px;background: #fff;color: #000;padding: 20px;width: 50%;"><a href="https://stepconference.com" style="color: black;text-decoration: none;">Dubai 2020</a><br> </p>
<p style="font-size: 17px;width: 50%;float: right;line-height: 60px;">  <a href="https://saudi.stepconference.com">Riyadh</a></p>
    <div style="clear:both;"></div>
</div>
</div>';
	if(isset($attributes["heading"])) {
        $output .= '<h1>' .$attributes["heading"] . '</h1>';
    }
        $output .= '<div class="action-buttons mobilev">
              <button type="button" class="btn" data-toggle="modal" data-target="#myModal">participate</button>
             </div>';
    if(isset($attributes["subheading"])) {
        $output .= '<p>'.$attributes["subheading"].'</p>';
    }

    if(isset($attributes["formShortcode"])) {
        $output .= do_shortcode($attributes["formShortcode"]);
    } else { $output .= '<div style="height:235px">&nbsp;</div>'; }
    
    
$output.=  '</section>
	</div>
</div>';
     }
     else {
         $output = '<div class="section hero-section"  data-vide-bg="'.$videobg.'" data-vide-options="posterType: jpg, loop: true, muted: true">
         <div class="beforeVideo">
         <div class="primary-overlay-bottom"></div>
           <video autoplay="" loop="" muted="">
             <source src="'.$attributes["mp4Url"].'" type="video/mp4" />
             <source src="'.$attributes["webmUrl"].'" type="video/webm" />
             </video>
             </div>
	<div class="section-contents theme-dark">

			<section class="techFestivalForm">
			<div class="event mobilev"><p class="date">February 13 - 14,2019<span>Dubai</span></p></div>';
	if(isset($attributes["heading"])) {
        $output .= '<h1>' .$attributes["heading"] . '</h1>';
    }
 $output .= '<div class="action-buttons mobilev">
              <button type="button" class="btn" data-toggle="modal" data-target="#myModal">participate</button>
             </div>';
    if(isset($attributes["subheading"])) {
        $output .= '<p class="sub-hh">'.$attributes["subheading"].'</p>';
    }

    if(isset($attributes["formShortcode"])) {
        $output .= do_shortcode($attributes["formShortcode"]);
    }
    else {
        $output .= '<div style="height:235px">&nbsp;</div>';
    }
    
    
$output.=  '</section>
	</div>
</div>';
     }
     
  return $output;
}
