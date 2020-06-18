<?php

namespace Gutenberg_Courses\Example_Block\Blocks\partners;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_partners_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_partners_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/partners', [
		'render_callback' => __NAMESPACE__ . '\render_partners_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_partners_block($attributes) {
	$cat_id = 24;
	if(isset($attributes["selectControl"])) {
		$cat_id = $attributes["selectControl"];
	}
	$category = get_term( $cat_id, 'category' );
	$recent_posts = wp_get_recent_posts( array(
        'numberposts' => -1,
        'post_status' => 'publish',
        'post_type' => 'partners',
        'cat' => $cat_id,
    ));

    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
    }

$currentUrl ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

$url ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 




    if($currentUrl=='https://stepconference.com/vw-mobility-challenge/')
    {
      $custom="partners dark2 custom-jj";  
      $partcolor="partcolor";
    }

 elseif(strpos($url,"?utm_source=") !== false) {
    $custom="partners dark2 custom-jj";  
      $partcolor="partcolor";

}

   else
{

      $custom="partners dark";

}


    
    $output = ' <section class="'.$custom.'" "'.$aa.'"> 
    <div class="centered1200">';
    	if(isset($attributes["title"])) {
			$output .= '<h2 class="'.$partcolor.'">'.$attributes["title"].'</h2>'; 
		}
		else {
			$output .= '<h2>'.$category->name.'</h2>';
		}
                 
            $output .= '<h4>'.$attributes["heading"].'</h4>
                  <div class="container">
                    <div class="double-border skewed">
                      <div class="content">
                        <div class="row listing">';
    foreach($recent_posts as $recent){
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
