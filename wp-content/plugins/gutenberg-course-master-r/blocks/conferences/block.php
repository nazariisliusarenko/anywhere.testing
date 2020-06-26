<?php

namespace Gutenberg_Courses\Example_Block\Blocks\conferences;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_conferences_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_conferences_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/conferences', [
		'render_callback' => __NAMESPACE__ . '\render_conferences_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_conferences_block($attributes) {
	$cat_id = 43;
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
    
    $output = '<section class="conference">
        <div class="row">
          <div class="col-md-12">
            <h2>'. $attributes["heading"] .'</h2>
            <p>'. $attributes["subheading"] .'</p>
            
            <ul class="logos">';
      
      foreach($recent_posts as $recent) {
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		  $output .= '<li><div class="logo"><a href="'.site_url().'/'.$recent["post_name"].'"><img src="'.$image[0].'" /></a></div></li>';
        
      }

   $output .='</ul>
          </div>
        </div>
        </section>';
	 wp_reset_query();
   return $output;
}
