<?php

namespace Gutenberg_Courses\Example_Block\Blocks\cards;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_cards_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_cards_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/cards', [
		'render_callback' => __NAMESPACE__ . '\render_cards_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_cards_block($attributes) {
	$cat_id = 40;
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
    
    $currentUrl ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
    $url ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

    if($currentUrl=='https://stepconference.com/vw-mobility-challenge/')
    {
      $custom="dark1";
    }
elseif (strpos($url,"?utm_source=") !== false) {
          $custom="";

}
else
{

}



    $output = ' <section class="what-you-get '.$custom.'">
    <div class="row">
      <div class="col-md-12 align-center">
        <h2>'.$category->name.'</h2>
        <p class="sub">'. $attributes["heading"] .'</p>
      </div>
    </div>
    <div class="row">';
    foreach( $recent_posts as $recent ){
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		$output .= '<div class="col-md-12 col-lg-4">
            <div class="whitebox"> 
            <img src="'.$image[0].'" />
            <h3>'.$recent["post_title"].'</h3>
            '.$recent["post_content"].'
            </div> 
            </div>';
	}
	$output .='</div>
	<div style="height:50px">&nbsp;</div>
	</section>';
	wp_reset_query();
    return $output;
}
