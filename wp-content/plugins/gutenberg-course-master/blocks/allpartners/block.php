<?php

namespace Gutenberg_Courses\Example_Block\Blocks\allpartners;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_allpartners_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_allpartners_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/allpartners', [
		'render_callback' => __NAMESPACE__ . '\render_allpartners_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_allpartners_block($attributes) {

	$cat_id = 24;
	if(isset($attributes["selectControl"])) {
		$cat_id = $attributes["selectControl"];
	}
	$args = array('parent' => 24);
$categories = get_categories( $args );
$filter = '';
$rows = '';
                  
  
foreach($categories as $category) { 
    $filter .= '<li><a href="javascript:;" data-val="'.strtolower(str_replace(' ', '', $category->name)).'">'.$category->name.'</a></li>';

	$recent_posts = wp_get_recent_posts( array(
        'numberposts' => -1,
        'post_type' => 'partners',
        'post_status' => 'publish',
        'cat' => $category->term_id,
    ));
    //echo "<pre>"; print_r($recent_posts); exit;

    foreach( $recent_posts as $recent ){
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		  $url = get_post_meta(  $recent["ID"], 'link', true);
		$rows .= '
		<div class="col-xs-6 partner-box-wrapper item-width '.strtolower(str_replace(' ', '', $category->name)).'"" style="clear:both">
    <div class="box"><a title="'.$recent["post_title"].'" href="'. $url .'" target="_blank" class="lazy-fade partner" data-original="'.$image[0].'" style="background-image: url(&quot;'.$image[0].'&quot;);"></a></div>
    </div>';
	} // end post
  
} // end category
	

   
    $output = '<section class="partners dark allpartners">
    <div class="centered1200">
    <h2>All Partners</h2>
                  <div class="container">
                    <div class="double-border skewed">
                      <div class="content">
                        <div class="row listing">
    <ul class="filter partnersfilter"><li><a href="javascript:;" data-val="allpartners">All Partners</a></li>
 '.$filter.'
</ul>
<br/><br/>'. $rows . '</div></div> </div></div></div></section>';
	wp_reset_query();
  return $output;
}
