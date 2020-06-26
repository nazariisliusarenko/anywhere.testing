<?php

namespace Gutenberg_Courses\Example_Block\Blocks\toggles;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_toggles_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_toggles_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/toggles', [
		'render_callback' => __NAMESPACE__ . '\render_toggles_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_toggles_block($attributes) {
	$cat_id = 37;
	if(isset($attributes["selectControl"])) {
		$cat_id = $attributes["selectControl"];
	}
	$category = get_term( $cat_id, 'category' );
	$recent_posts = wp_get_recent_posts( array(
        'numberposts' => -1,
        'post_status' => 'publish',
        'cat' => $cat_id,         
    ));

    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
    }
    $output = '';
    $rangeControlValue = 'col-md-6';
    if(isset($attributes["rangeControl"])){
      
      if($attributes["rangeControl"]==1){
        $rangeControlValue = 'col-md-12';
      }
      
      if($attributes["rangeControl"]==3){
        $rangeControlValue = 'col-md-4';
      }
      
      if($attributes["rangeControl"]==4){
        $rangeControlValue = 'col-md-3';
      }
      
    }
    if($attributes["togglesType"]=="insideWhite") {
      $output .= '<style> 
      .content.active { background-color:#fff } 
      .accordion .content p, section.toggles ul > li { color:#15122F; } 
      </style>';
    }
    if($attributes["togglesType"]=="backgroundWhite") {
      $output .= '<style> section.toggles, section.toggles h2, section.toggles p, .content.active, .accordion a , accordion .content p , .accordion a:hover ,  section.toggles > ul > li { background-color:#fff; color:#15122F!important; border:none } .content p { color:#15122F } </style>';
    }

$currentUrl ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
$url ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

    if($currentUrl=='https://stepconference.com/vw-mobility-challenge/')
    {
      $custom="togg-vw";
      $bg="dark2 tt";
      $content_custom="content-vw-custom";
    }
elseif (strpos($url,"?utm_source=") !== false) {
      $custom="togg-vw";
      $bg="dark2 tt";
      $content_custom="content-vw-custom";

}
else
{

}


    
    $output .= '<section class="toggles '.$bg.'">';
    
      $output .= '<div class="row"><div class="col-md-12 center ac">';
      $output .= '<h2>'.$attributes["heading"].'</h2>';
      $output .= '<div style="color:white;padding: 17px;">'. $attributes["textareaDescription"] .'</div>';
      $output .= '</div></div>';

      $output .='<div class="container"><div class="row"><div class="accordion" id="outer-accordion">';
      foreach($recent_posts as $recent) {
    	$image = wp_get_attachment_image_src(get_post_thumbnail_id($recent["ID"]), 'single-post-thumbnail' );
		  $output .= '<div class="'.$rangeControlValue.'">';
		  $output .= '<div class="accordion-item">
          <a class='.$custom.'>'.$recent["post_title"].'</a>
          <div class="content '.$content_custom.'" id="inner-accordion">
            '.strip_tags($recent["post_content"],"<div>,<br/>,<ul>,<li>,<a><strong>").'
          </div>
          </div>';
          $output .= '</div>';
	    }  
      $output .= '</div>';
      
$output .= '</div></div><div style="height:50px">&nbsp;</div></section>';
    
	wp_reset_query();
    return $output;
}
