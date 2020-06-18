<?php

namespace Gutenberg_Courses\Example_Block\Blocks\people;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_people_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_people_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/people', [
		'render_callback' => __NAMESPACE__ . '\render_people_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_people_block($attributes) {
	$cat_id = 32;
	if(isset($attributes["selectControl"])) {
		$cat_id = $attributes["selectControl"];
	}
	$category = get_term( $cat_id, 'category' );
	$recent_posts = wp_get_recent_posts( array(
        'numberposts' => -1,
        'post_status' => 'publish',
        'post_type' => 'people',
        'cat' => $cat_id,
    ));

    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
    }
     $heading = $attributes["heading"];
     if($heading=='STEP 2020 Line-up'){
        $displayCss=0;
     }
    else
    {
        $displayCss=1;
     }

    if($_SESSION['screen_width']>900){
    $output = '<section class="speakers">
    <div class="centered1200">
    <header class="clearfix">
        <h2 class="head-speakers">'. $attributes["heading"] .'</h2>
        <span>'. $attributes["subheading"] .'</span>
        </header>
        <div class="dd">
        <ul id="og-grid" class="og-grid">';
    foreach( $recent_posts as $recent ){
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		 $company  = get_post_meta(  $recent["ID"], 'company', true);
		 $content  = get_post_meta(  $recent["ID"], 'content', true);
		$output .= '
		<li>
          <a href="#" data-id="'.site_url().'/wp-content/themes/grandconference-childtheme/subpage.php?id='.$recent["ID"].'" data-largesrc="'.$image[0].'" data-title="'.$recent["post_title"].'" data-company="'.$company.'" data-description="'.$content.'"> 
            <div class="primary-overlay-bottom"></div>
            <i class="fa fa-plus"></i><img  src="'.$image[0].'" alt=""/>
            <p class="title">'.str_replace(" ","<br />",$recent["post_title"]).'
              <span>'.$company.'</span>
            </p>
          </a>
        </li>';
	}
	$output .='</ul>
        </div>
          <br/>';
          if($displayCss==0){
       $output .=' <div class="action-buttons stepbutton;" style="text-align:center;">

           <a href="https://stepconference.com/step-2020-speakers" style="width:161px !important;" class="btn" target="_blank" rel="noopener noreferrer">See More Speakers</a>
</div>';
       }
        $output .='</div>
</section>
';
	wp_reset_query();
    return $output;
    }
    else {
      $output = '<section class="people" style="background:white !important">
      <h2 style="color: #f0ff!important;">'. $attributes["heading"] .'</h2>
      <span style="color:#f0ff !important;margin-left:40px;">'. $attributes["subheading"] .'</span>
      <div class="people-container container">
      <div class="row listing">';
      foreach( $recent_posts as $recent ){
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		  $company  = get_post_meta(  $recent["ID"], 'company', true);
		  $content  = get_post_meta(  $recent["ID"], 'content', true);
      $output .= '<div class="person-wrapper col-xs-6 col-md-15">';
      $output .= '<div class="lazy person" data-original="'.$image[0].'" style="background-image: url(&quot;'.$image[0].';);">';
      $output .= '<div class="primary-overlay"></div>';
      $output .= '<i class="fa fa-plus"></i>';
      $output .= '<div class="info"><h3>'.str_replace(" ","<br />",$recent["post_title"]).'</h3>';
      $output .= '<div class="title">'.$company.'</div></div>';
      $output .= '<div class="gradient"></div>';
      $output .= '<div class="person-preview"><a href="#" class="close-btn"><i class="fa fa-fw fa-times"></i></a> <a href="#" class="close-btn close-btn-outer"><i class="fa fa-fw fa-times"></i></a>';
      $output .= '<div class="preview-data-container"><div class="preview-image"><img src="'.$image[0].'"><div class="double-border frame"></div></div>';
      $output .= '<div class="preview-info"><h2>'.str_replace(" ","<br />",$recent["post_title"]).'</h2>';
      $output .= '<h4>'.$company.'</h4>';
      $output .= '<div class="biography">'.$content.'</div></div></div></div></div></div>';
      }
      $output .= '</div>';
if($displayCss==0){
       $output .=' <div class="action-buttons stepbutton;" style="text-align:center;">

           <a href="https://stepconference.com/step-2020-speakers" style="width:161px !important;" class="btn" target="_blank" rel="noopener noreferrer">See More Speakers</a>
</div>';
       }


$output .='</div></section>';
      
      return $output;
    }
}
