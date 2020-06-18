<?php

namespace Gutenberg_Courses\Example_Block\Blocks\tickets;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_tickets_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_tickets_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/tickets', [
		'render_callback' => __NAMESPACE__ . '\render_tickets_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_tickets_block($attributes) {

	$cat_id = 127; //127
	if(isset($attributes["selectControl"])) {
		$cat_id = $attributes["selectControl"];
	}
	$args = array('parent' => 127);
$categories = get_categories( $args );
$filter = '';
$tickets = '';
$model = '';
foreach($categories as $category) { 
    $filter .= '<li><a href="javascript:;" data-val="'.strtolower(str_replace(' ', '', $category->name)).'">'.$category->name.'</a></li>';
    
    
	$recent_posts = wp_get_recent_posts( array(
        'numberposts' => -1,
        'post_type' => 'tickets',
        'post_status' => 'publish',
        'cat' => $category->term_id,
    ));
    //echo "<pre>"; print_r($recent_posts); exit;

    foreach( $recent_posts as $recent ){
      $today = date("Y-m-d h:i:sa");
      $start = get_post_meta($recent["ID"],'starts_on',true);
      $expire = get_post_meta($recent["ID"],'ends_on',true); //from database

      $today_time = strtotime($today);
      $start_time = strtotime($start);
      $expire_time = strtotime($expire);
      $disabled = ""; $unvisible = get_post_meta($recent["ID"],'ticket_link',true) ;
      if (($start_time < $today_time  && $today_time > $expire_time) || ($expire_time > $today_time && $start_time > $today_time) ) { /* do Something */  $disabled = "disabled"; $unvisible = "javascript:;";}
      $color = get_term_meta( $category->term_id, 'bgcolor', true );
      //Split string into an array.  Each element is 2 chars
      $start = str_split(get_post_meta($recent["ID"],'starts_on',true), 2);
      $end = str_split(get_post_meta($recent["ID"],'ends_on',true), 2);
      
      $tickets .= '<li class="'.strtolower(str_replace(' ', '', $category->name)).'">   
    <div class="ticket ' . $disabled .'">
      <div class="head" style="background-color:'.$color.'">'.$category->name.'</div>
      <div class="content">
        <h4>'.$recent["post_title"].'</h4>
        <span>ends on '. $end[3] .'/'. $end[2] . '</span>';
        if(get_post_meta($recent["ID"],'strikethrough_price',true)){
         $tickets .=  '<h3>'.get_post_meta($recent["ID"],'currency',true) . get_post_meta($recent["ID"],'strikethrough_price',true).'</h3>'; 
        }
        else {
          $tickets .= '<h3 style="min-height:50px"></h3>';
        }
        if(get_post_meta($recent["ID"],'price',true)){
          $tickets .= '<h2>'.get_post_meta($recent["ID"],'currency',true) . get_post_meta($recent["ID"],'price',true).'</h2>';
        }
        else {
          $tickets .= '<h2 style="min-height:50px">-</h2>';
        }
         $tickets .= '<a href="#" class="moreinfo" data-toggle="modal" data-target="#myModal'.$recent["ID"].'">more info</a><br/><br/>
        <a href="'.$unvisible.'" target="_blank" class="buy">'.get_post_meta($recent["ID"],'button_name',true).'</a>     
      </div>
    </div>
  </li>';
  $model .= '
<div class="modal" id="myModal'.$recent["ID"].'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="head" style="background-color:'.$color.'">'.$category->name.'</div>
		<h4>'.$recent["post_title"].' '. get_post_meta($recent["ID"],'currency',true) . get_post_meta($recent["ID"],'price',true) .'</h4>
		<span>ends on '. $end[3] .'/'. $end[2] . '</span>
        <h3>'. get_post_meta($recent["ID"],'subtitle',true).'</h3>
        <div class="content">'.$recent["post_content"].'</div>
      </div>
    </div>
  </div>
</div>';
  
    } // end post
} // end category
	

    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
    }
    
    $output = ' <section class="alltickets">
<ul class="filter ticketsfilter" style="display:none;">
  <li><a href="#" data-val="alltickets">All Tickets</a></li>
 '.$filter.'
</ul>
<br/><br/>
<ul class="tickets">'.$tickets.'</ul>';
$output .= $model;
$output .= '</section>';
	wp_reset_query();
    return $output;
}
