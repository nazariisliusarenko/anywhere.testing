<?php

namespace Gutenberg_Courses\Example_Block\Blocks\allspeakers;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_allspeakers_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_allspeakers_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/allspeakers', [
		'render_callback' => __NAMESPACE__ . '\render_allspeakers_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_allspeakers_block($attributes) {
  
	$idObj = get_category_by_slug('filters'); 
  $cat_id = $idObj->term_id;
  $args = array('parent' => $cat_id);
  $filters = get_categories( $args );

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
    if($_SESSION['screen_width']>900){
    $output = '<section class="speakers">
    <header class="clearfix">
        <h2>'. $attributes["heading"] .'</h2>
        <span>'. $attributes["subheading"] .'</span>
        </header>
        ';
   if(!isset($attributes["selectControl"])) :     
      $output .='<div class="schedule-tabs" style="margin:0 auto; max-width:1200px"><ul class="persontab">
      <li><a href="javascript:;" data-filterid="all">All</a></li>';
      foreach($filters as $filter):
      $output .='<li><a href="javascript:;" data-filterid="filter'.$filter->term_id.'">'.$filter->name.'</a></li>';
      endforeach;
    $output .='</ul></div>';
    endif;
    $output .='<div class="dd">
        <ul id="og-grid" class="og-grid">';
    foreach( $recent_posts as $recent ){
      
      // added for the filter fix
    $newfilter = get_the_category( $recent["ID"] );
    $filclass = '';
    foreach($filters as $mainfilter): 
      foreach ($newfilter as $fil){
        if($mainfilter->term_id == $fil->term_id):
        $filclass = 'filter'.$fil->term_id;
        break;
        endif;
        
      }
    endforeach;
      // end the filter fix
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		 $company  = get_post_meta(  $recent["ID"], 'company', true);
		 $content  = get_post_meta(  $recent["ID"], 'content', true);
		$output .= '
		<li class="'.$filclass.'">
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
          <br/>
        <!--<div class="align-center">
            <a class="btn btn-md-2 morespeakers" href="#">See More Speakers</a>
        </div>-->
</section>
<script>
jQuery("document").ready(function(){
   $(".persontab").find("li").on("click",function(e){
      e.preventDefault();
      $(".persontab").find("li").removeClass("active");
      $(this).addClass("active");
      filterid = $(this).find("a").attr("data-filterid");
      if(filterid=="all") {
         $(".og-grid").find("li").show();
      }
      else {
        $(".og-grid").find("li").hide();
        $(".og-grid").find("li."+filterid).show();
      }
    });
});

</script>
';
	wp_reset_query();
    return $output;
    }
    else {
      $output = '<section class="people dark">
      <h2>'. $attributes["heading"] .'</h2>
      <span>'. $attributes["subheading"] .'</span>
      <div class="people-container container">';
         if(!isset($attributes["selectControl"])) :     
      $output .='<div class="schedule-tabs" style="margin:0 auto; max-width:1200px"><ul class="persontab">
      <li><a href="javascript:;" data-filterid="all">All</a></li>';
      foreach($filters as $filter):
      $output .='<li><a href="javascript:;" data-filterid="filter'.$filter->term_id.'">'.$filter->name.'</a></li>';
      endforeach;
   endif;
      $output .= '<div class="row listing">';
      foreach( $recent_posts as $recent ){
        
           // added for the filter fix
    $newfilter = get_the_category( $recent["ID"] );
    $filclass = '';
    foreach($filters as $mainfilter): 
      foreach ($newfilter as $fil){
        if($mainfilter->term_id == $fil->term_id):
        $filclass = 'filter'.$fil->term_id;
        break;
        endif;
        
      }
    endforeach;
      // end the filter fix
      
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
		  $company  = get_post_meta(  $recent["ID"], 'company', true);
		  $content  = get_post_meta(  $recent["ID"], 'content', true);
      $output .= '<div class="person-wrapper col-xs-6 col-md-15 '.$filclass.'">';
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
      $output .= '</div></div></section><script>
jQuery("document").ready(function(){
   $(".persontab").find("li").on("click",function(e){
      e.preventDefault();
      $(".persontab").find("li").removeClass("active");
      $(this).addClass("active");
      filterid = $(this).find("a").attr("data-filterid");
      if(filterid=="all") {
         $(".persontab").find(".person-wrapper").show();
      }
      else {
        $(".persontab").find(".person-wrapper").hide();
        $(".persontab").find("."+filterid).show();
      }
    });
});

</script>';
      
      return $output;
    }
}
