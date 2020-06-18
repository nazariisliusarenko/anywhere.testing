<?php

namespace Gutenberg_Courses\Example_Block\Blocks\schedules;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_schedules_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_schedules_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/schedules', [
		'render_callback' => __NAMESPACE__ . '\render_schedules_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_schedules_block($attributes) {
$output = '<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
  <style>
  body {
    background-image:none;
    background-color:#171232;
  }
    /*.days-tabs {
      visibility:hidden;
    }*/
    .schedule-subject {
      cursor:pointer;
    }
    .hide {
      visibility:hidden;
    }
    .show {
      visibility:visible!important;
    }
  </style>
<section id="Schedule">
<center><h1>'.$attributes["heading"].'</h1></center>
<div class="schedule-tabs">';

  $idObj = get_category_by_slug('conference-agenda'); 
  $cat_id = $idObj->term_id;
  $args = array('parent' => $cat_id);
  $categories = get_categories( $args );

$output .='<ul class="cattab">
      <li><a href="javascript:;" data-catid="all">All Conferences</a></li>';
      foreach($categories as $category):
      $output .='<li><a href="javascript:;" data-catid="cat'.$category->term_id .'">'.$category->name .'</a></li>';
      endforeach;
$output .= '</ul>
</div>
<br/>
<div class="schedule-tabs session-tabs">';
  $idObj = get_category_by_slug('sessions'); 
  $cat_id = $idObj->term_id;
  $args = array('parent' => $cat_id);
  $sessions = get_categories( $args );

$output .='<ul class="sessiontab">
      <li><a href="javascript:;" data-sessionid="all">All Sessions</a></li>';
      foreach( $sessions as $session ):
      $output .='<li><a href="javascript:;" data-sessionid="session'.$session->term_id .'">'.$session->name .'</a></li>';
      endforeach;
$output .='</ul>
</div>
<br/>
<div class="days-tabs">
<ul class="daytab">
      <li><a href="javascript:;" data-day="all">All Days</a></li>';
       $recent_posts = wp_get_recent_posts( array(
        'numberposts' => -1,
        'post_type' => 'sessions',
        'post_status' => 'publish',
        'order'     => 'ASC',
        'orderby'   => 'meta_value', //or 'meta_value_num'
        'meta_query' => array(
                    array('key' => 'day', 'key' => 'start_time'))
    ));
      $cntval = 1;
      $liste = array();
      foreach( $recent_posts as $recent ):
        // condition of fix to make single dates instead of repeating dates
        $value = get_post_meta($recent["ID"],'day',true);
        
        if(!in_array($value, $liste, true)):
        array_push($liste, $value);
    
             $category = get_the_category( $recent["ID"] );
     $catlist = '';
     $catclass = '';
    foreach($categories as $maincat): 
      foreach ( $category as $cat){
        if($maincat->term_id == $cat->term_id):
        $catclass = 'cat'.$cat->term_id;
        break;
        endif;
        
      }
    endforeach;
        foreach($sessions as $mainsess): 
      foreach ( $category as $cat){
        if($mainsess->term_id == $cat->term_id):
        $sessclass = 'session'.$cat->term_id;
        break;
        endif;
        
      }
    endforeach;

 $output .= '<li class="<?= $catclass ?> <?= $sessclass ?>"><a href="javascript:;" data-day="day<?= $value ?>">Day <?= $cntval ?></a>&nbsp;<span class="date">'.formatDate(get_post_meta($recent["ID"],'day',true)).'</span></li>';
      $cntval++;
      
      endif; // end added condition
      
      endforeach;
      
    
  $output .= '</ul>
</div>
<br/>
<div id="accordion">';

$cntval = 1;
$liste = array();
   foreach( $recent_posts as $recent ):
     $category = get_the_category( $recent["ID"] );
     $catlist = '';
     $catclass = '';
    foreach($categories as $maincat): 
      foreach ( $category as $cat){
        if($maincat->term_id == $cat->term_id):
        $color = get_term_meta( $cat->term_id, 'bgcolor', true );
        $catlist = '<span class="label orange" style="background-color:'.$color.'">'.$cat->name.'</span>';
        $catclass = 'cat'.$cat->term_id;
        break;
        endif;
      }
    endforeach;
$output .='
<div class="schedule-row '. $catclass .' day' . $value .' session' . $session->term_id .'">
  <ul>
    <li><div class="icon-calendar">&nbsp;</div>' . formatDate(get_post_meta($recent["ID"],'day',true)) .'</li>
    <li><div class="icon-clock-o">&nbsp;</div>'.date("g:i a", strtotime(get_post_meta($recent["ID"],'start_time',true) . " UTC")) .'</li>
    <li><div class="icon-map-pin-streamline">&nbsp;</div>'.get_post_meta($recent["ID"],'location',true) .'</li>
    <li>'. $catlist .'</li>
  </ul>
  <!-- start schedule subject -->
  <div class="schedule-subject">
    <h2>'. $recent["post_title"] .'</h2>
    <p>'. wp_trim_words( strip_shortcodes( strip_tags( $recent["post_content"] ) ), 20 ) .'</p>
  </div> <!-- end schedule subject -->
  <!-- start schedule content -->
  <div class="schedule-content">
    <ul>
      <li>'. date("g:i a", strtotime(get_post_meta($recent["ID"],'start_time',true) . " UTC")) .'</li>
      <li>'. date("g:i a", strtotime(get_post_meta($recent["ID"],'end_time',true) . " UTC")) .'</li>
      <li>'. get_post_meta($recent["ID"],'location',true) .'</li>
    </ul>
    <p>'. $recent["post_content"] .'</p>
    <ul>';
      if(!empty(get_post_meta($recent["ID"],'speaker',true))){
        $speakers = get_post_meta($recent["ID"],'speaker',true);
        foreach($speakers as $speakerid):
        $speaker = get_post($speakerid);
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($speakerid), 'thumbnail');
        $output .= '<li>
        <img src="'. $thumb[0] .'" />
        <div>
        <span class="title">'.$speaker->post_title .'</span>
        <span class="subtitle">'.get_post_meta($speaker->ID,'company',true) .'</span>
        </div>
        
      </li>';
        endforeach;
      }
  $output .= '</ul>
  </div> <!-- end schedule content -->
</div><!-- end schedule row -->
';
        $value = get_post_meta($recent["ID"],'day',true);
        
        if(!in_array($value, $liste, true)):
        array_push($liste, $value);
        $cnt++;
        endif;
        
endforeach;
  
$output .= '</div><!-- end accordion -->
</section>
';
    return $output;
}
