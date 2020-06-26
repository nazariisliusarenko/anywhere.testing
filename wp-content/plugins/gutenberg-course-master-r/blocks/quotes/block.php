<?php

namespace Gutenberg_Courses\Example_Block\Blocks\quotes;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_quotes_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_quotes_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/quotes', [
		'render_callback' => __NAMESPACE__ . '\render_quotes_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_quotes_block($attributes) {
	$cat_id = 39;
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
    $cnt = 0;
    $li = '';
    $active = 'active';
    if($_SESSION['screen_width']>900){
    $output = '<section class="fairly-quotes">
        <div class="container-fluid">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">';
    foreach( $recent_posts as $recent ){
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		$output .= '
		<div class="item '.$active.'">
              <div class="row main align-items-center">
                <div class="col-md-6 clip-right">
                  <h2>'.strip_tags($recent["post_content"]).'</h2>
                  <p>'.$recent["post_title"].'</p>
                  </div>
                  <div class="col-md-6 image-element align-self-stretch">
                      <div class="img-wrap">
                          <div class="primary-overlay-bottom"></div>
                          <img src="'.$image[0].'" media-simple="true">
                      </div>
                  </div>
              </div>
          </div>';
        
    $li .= '<li data-target="#myCarousel" data-slide-to="'.$cnt.'"  class="'.$active.'"></li>';
    $active = '';
    $cnt++;
	}
	$output .='</div>
	

                    
                    
                        
        <ol class="carousel-indicators">
          '.$li .'
        </ol>
                    
    
      </div></div>
      </section>
      ';
}
  else {
    
    $output = '<section class="fairly-quotes">
        <div class="container-fluid">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">';
    foreach( $recent_posts as $recent ){
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		$output .= '
		<div class="item '.$active.'">
              <div class="row main align-items-center">
                 <div class="col-md-6 image-element align-self-stretch">
                      <div class="img-wrap">
                          <div class="primary-overlay-bottom"></div>
                          <img src="'.$image[0].'" media-simple="true">
                      </div>
                </div>
                <div class="col-md-6 clip-right">
                  <h2>'.strip_tags($recent["post_content"]).'</h2>
                  <p>'.$recent["post_title"].'</p>
                </div>
              </div>
          </div>';
        
    $li .= '<li data-target="#myCarousel" data-slide-to="'.$cnt.'"  class="'.$active.'"></li>';
    $active = '';
    $cnt++;
	}
	$output .='</div>
	

                    
                    
                        
        <ol class="carousel-indicators">
          '.$li .'
        </ol>
                    
    
      </div></div>
      </section>
      ';
    
  }
	wp_reset_query();
    return $output;
}
