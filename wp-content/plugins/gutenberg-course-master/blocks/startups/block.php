<?php

namespace Gutenberg_Courses\Example_Block\Blocks\startups;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_startups_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_startups_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/startups', [
		'render_callback' => __NAMESPACE__ . '\render_startups_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_startups_block($attributes) {
	$idObj = get_category_by_slug('step-2019-startups'); 
    $cat_id = $idObj->term_id;
	if(isset($attributes["selectControl"])) {
		$cat_id = $attributes["selectControl"];
	}
	$category = get_term( $cat_id, 'category' );
	$recent_posts = wp_get_recent_posts( array(
        'numberposts' => -1,
        'post_status' => 'publish',
        'post_type' => 'startups',
        'cat' => $cat_id,
    ));

    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
    }
    
    $output = ' <section class="partners dark">
    <div class="centered1200">
                  <h2>'.$category->name.'</h2>
                  <p class="sub">'.$attributes["heading"].'</p>
                  <div class="container">
                    <div class="double-border skewed">
                      <div class="content">
                        <div class="row listing">';
    foreach( $recent_posts as $recent ){
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		  $url = get_post_meta(  $recent["ID"], 'link', true);
		$output .= '
		<div class="col-xs-6 partner-box-wrapper item-width" style="clear:both">
    <div class="box"><a title="'.$recent["post_title"].'" href="'. $url .'" target="_blank" class="lazy-fade partner" data-original="'.$image[0].'" style="background-image: url(&quot;'.$image[0].'&quot;);"></a></div>
    </div>';
	}
	$output .='</div></div> </div></div> 
	</div>
	</section>';
	wp_reset_query();
  return $output;
}
