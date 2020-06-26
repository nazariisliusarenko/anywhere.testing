<?php


/**
 * Add new colorpicker field to "Add new Category" screen
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param String $taxonomy
 *
 * @return void
 */
function colorpicker_field_add_new_category( $taxonomy ) {

  ?>

    <div class="form-field term-colorpicker-wrap">
        <label for="term-colorpicker">Category Color</label>
        <input name="_category_color" value="#ffffff" class="colorpicker" id="term-colorpicker" />
        <p>This is the field description where you can tell the user how the color is used in the theme.</p>
    </div>

  <?php

}
add_action( 'category_add_form_fields', 'colorpicker_field_add_new_category' );  // Variable Hook Name


// Show posts of 'post', 'page', 'acme_product' and 'movie' post types on home page
function search_filter( $query ) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ( $query->is_search ) {
      $query->set( 'post_type', array( 'blog' ) );
    }
  }
}
 
add_action( 'pre_get_posts','search_filter' );
/**
 * Add new colopicker field to "Edit Category" screen
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param WP_Term_Object $term
 *
 * @return void
 */
function colorpicker_field_edit_category( $term ) {

    $color = get_term_meta( $term->term_id, '_category_color', true );
    $color = ( ! empty( $color ) ) ? "#{$color}" : '#ffffff';

  ?>

    <tr class="form-field term-colorpicker-wrap">
        <th scope="row"><label for="term-colorpicker">Severity Color</label></th>
        <td>
            <input name="_category_color" value="<?php echo $color; ?>" class="colorpicker" id="term-colorpicker" />
            <p class="description">This is the field description where you can tell the user how the color is used in the theme.</p>
        </td>
    </tr>

  <?php


}
add_action( 'category_edit_form_fields', 'colorpicker_field_edit_category' );   // Variable Hook Name


/**
 * Term Metadata - Save Created and Edited Term Metadata
 * - https://developer.wordpress.org/reference/hooks/created_taxonomy/
 * - https://developer.wordpress.org/reference/hooks/edited_taxonomy/
 *
 * @param Integer $term_id
 *
 * @return void
 */
function save_termmeta( $term_id ) {

    // Save term color if possible
    if( isset( $_POST['_category_color'] ) && ! empty( $_POST['_category_color'] ) ) {
        update_term_meta( $term_id, '_category_color', sanitize_hex_color_no_hash( $_POST['_category_color'] ) );
    } else {
        delete_term_meta( $term_id, '_category_color' );
    }

}
add_action( 'created_category', 'save_termmeta' );  // Variable Hook Name
add_action( 'edited_category',  'save_termmeta' );  // Variable Hook Name

/**
 * Enqueue colorpicker styles and scripts.
 * - https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
 *
 * @return void
 */
/*function category_colorpicker_enqueue( $taxonomy ) {

    if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
        return;
    }

    // Colorpicker Scripts
    wp_enqueue_script( 'wp-color-picker' );

    // Colorpicker Styles
    wp_enqueue_style( 'wp-color-picker' );

}
add_action( 'admin_enqueue_scripts', 'category_colorpicker_enqueue' );

/**
 * Print javascript to initialize the colorpicker
 * - https://developer.wordpress.org/reference/hooks/admin_print_scripts/
 *
 * @return void
 *
function colorpicker_init_inline() {

    if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
        return;
    }

  ?>

    <script>
        jQuery( document ).ready( function( $ ) {

            $( '.colorpicker' ).wpColorPicker();

        } ); // End Document Ready JQuery
    </script>

  <?php

}
add_action( 'admin_print_scripts', 'colorpicker_init_inline', 20 );
*/

// Enqueue CSS and JS
//require_once( __DIR__ . '/lib/enqueue-assets.php' );
// Add Theme Support
//require_once( __DIR__ . '/lib/theme-support.php' );
//add_action( 'register_post_type_args', 'block_templates', 20, 2 );
/**
 * Enqueue theme CSS and JavaScript .
 */
/*function block_templates( $args, $post_type ) {

	if ( 'post' === $post_type) {
		$args[ 'template' ] = [
			[
				'core/heading', [
					'placeholder' => __( 'Subheadline', 'gutenbergtheme' )
				]
			],
			[
				'core/image', [
					'align' => 'right',
				]
			],			
			[
				'core/paragraph', [
					'align' => 'left',
					'placeholder' => __( 'Incididunt aliquip culpa dolore amet sunt voluptate excepteur aliqua deserunt in cillum ullamco est sit. Incididunt aliquip culpa dolore amet sunt voluptate excepteur aliqua deserunt in cillum ullamco est sit.', 'gutenbergtheme' )
				]
			],
			[
				'core/separator'
			],			
			[
				'core/heading', [
					'placeholder' => __( 'Another Subheadline', 'gutenbergtheme' )
				]
			],			
			[
				'core/text-columns', [
					'columns' => '3'					
				]
			],
			[
				'core/paragraph', [					
					'placeholder' => __( 'Irure minim velit dolore sint tempor officia. Cupidatat enim dolore sunt enim pariatur et minim eiusmod Lorem id exercitation reprehenderit. In deserunt voluptate commodo officia adipisicing adipisicing voluptate culpa magna fugiat ullamco. Proident excepteur excepteur pariatur irure voluptate quis in est aute nulla cillum quis consectetur. Reprehenderit eiusmod commodo excepteur ipsum laboris voluptate.', 'gutenbergtheme' )
				]
			],
		];
	}

	return $args;	
	
}
*/
// add shortcodes
add_shortcode('stepbutton','stepbutton_embed_shortcode');

function stepbutton_embed_shortcode($atts) {

    extract(shortcode_atts(array(
        'btn_name' => 'ylefebvre',
        'btn_link' => 'ylefebvre',
        'blank' => 'ylefebvre'
        ),$atts));
        
    if(!empty($btn_link)){
        $output = '<div class="action-buttons stepbutton">';
        if($blank=="true") {
          $output .= '<a href="'.$btn_link.'" class="btn" target="_blank">'.$btn_name.'</a>';  
        }
        else {
         $output .= '<a href="'.$btn_link.'" class="btn" >'.$btn_name.'</a>';   
        }
        $output .= '</div>';
        }
        else {
            $output = '';
        }
        return $output;

}
add_filter( 'body_class', 'add_gutenberg_compatible_body_class' );
/**
 * Add custom class for Gutenberg Compatible template
 */
function add_gutenberg_compatible_body_class( $classes ) {
    if( is_page_template('page-full-width.php') )
        $classes[] = 'gutenberg-compatible-template';
    return $classes;
}

function my_theme_enqueue_styles() {

    $parent_style = 'grandconference'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts',  'my_theme_enqueue_styles');

add_action('init', 'start_session', 1);
function start_session() {
if(!session_id()) {
session_start();
}
}
/*
# =================================================
# functions.php
#
# The theme's functions.
# =================================================
*/

/* ------------------------------------------------ */
/* 1. CONSTANTS */
/* ------------------------------------------------ */
define( 'THEMEROOT', get_stylesheet_directory_uri());
define( 'IMAGES', THEMEROOT . '/app/images' );
define( 'JS', THEMEROOT . '/app/js' );



/* ------------------------------------------------ */
/* 2. THEME SETUP */
/* ------------------------------------------------ */

if(! function_exists('get_startup_events')) {
    function get_startup_events() {
        // WP_Query arguments
$args = array (
	'post_type'              =>'events',
	'post_status'            =>'publish',
	'nopaging'               => true,
	'order'                  => 'ASC'
);

// The Query
$events = new WP_Query( $args );
// The Loop
if ( $events->have_posts() ) {
    $output = '';
	while ( $events->have_posts() ) {
	    $events->the_post();
	$output .= '<div class="event" style="display:none;">
          <p class="date">'. get_post_meta(get_the_ID(),'date',true);
    $output .= '<span>'.get_the_title().'</span>
          </p>
        </div>';
	}
$output .='<div class="dropdown">
  <p class="dropbtn">
    <a href="https://stepconference.com" class="dropbtn">
        <p class="event-place"> <span class="event-place-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span><span class="dropdown-span">Anywhere<span class="chevron-btn" ><i class="fa fa-chevron-down" aria-hidden="true"></i></span> </span></p>
        <p class="event-time">August 24-26 2020</p>
    </a>
  </p>
  <div class="dropdown-content">
    <a href="https://stepconference.com/step2021/">Dubai 2021</a>
    <a href="https://saudi.stepconference.com">Riyadh 2020</a>    
  </div>
</div>
<a href="https://stepconference.com/vw-mobility-challenge/" style="
    margin-left: -73px;display:none;
"><img class="logo" src="https://stepconference.com/wp-content/uploads/2019/10/vw-new.svg"></a>';

echo $output;
}

// Restore original Post Data
wp_reset_postdata();
    }
}
if ( ! function_exists( 'stepconference_theme_setup' ) ) {
    function stepconference_theme_setup() {
        /* Make the theme available for translation. */
        $lang_dir = THEMEROOT . '/languages';
        load_theme_textdomain( 'stepconference', $lang_dir );



        /* Register nav menus. */
        register_nav_menus( array(
            'main-menu' => __( 'Main Menu', 'stepconference' )
        ) );
        register_nav_menus( array(
            'socialmedia-menu' => __( 'Social Media', 'stepconference' )
        ) );
        register_nav_menus( array(
            'participate-menu' => __( 'Participate Menu', 'stepconference' )
        ) );
        register_nav_menus( array(
            'right-menu' => __( 'Right Menu', 'stepconference' )
        ) );
    }

    add_action( 'after_setup_theme', 'stepconference_theme_setup',30 );
}






/* ------------------------------------------------ */
/* 4. NUMBERED PAGINATION */
/* ------------------------------------------------ */
/*if ( ! function_exists( 'stepconference_numbered_pagination' ) ) {
    function stepconference_numbered_pagination() {
        $args = array(
            'prev_next' => false,
            'type' => 'array'
        );

        echo '<div class="col-md-12">';
        $pagination = paginate_links( $args );

        if ( is_array( $pagination ) ) {
            echo '<ul class="nav nav-pills">';
            foreach ( $pagination as $page ) {
                if ( strpos( $page, 'current' ) ) {
                    echo '<li class="active"><a href="#">' . $page . '</a></li>';
                } else {
                    echo '<li>' . $page . '</li>';
                }
            }

            echo '</ul>';
        }

        echo '</div>';
    }
}



/* ------------------------------------------------ */
/* 5. REGISTER WIDGET AREAS */
/* ------------------------------------------------ */
/*if ( ! function_exists( 'stepconference_widget_init' ) ) {
    function stepconference_widget_init() {
        if ( function_exists( 'register_sidebar' ) ) {
            register_sidebar( array(
                'name' => __( 'Main Widget Area', 'stepconference' ),
                'id' => 'main-sidebar',
                'description' => __( 'Appears in the blog pages.', 'stepconference' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div> <!-- end widget -->',
                'before_title' => '<h2>',
                'after_title' => '</h2>'
            ) );
        }
    }

    add_action( 'widgets_init', 'stepconference_widget_init' );
}



/* ------------------------------------------------ */
/* 6. SCRIPTS */
/* ------------------------------------------------ */

function my_init() 
{
    if (!is_admin()) 
    {
        wp_deregister_script('jquery');

        // Load the copy of jQuery that comes with WordPress
        // The last parameter set to TRUE states that it should be loaded
        // in the footer.
        //wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', FALSE, '1.11.0', TRUE);

        //wp_enqueue_script('jquery');

    }
}
//add_action('init', 'my_init');

if(!function_exists('formatTime')){
    function formatTime($time) {
        
    }
}

if(!function_exists('formatDate')){
function formatDate($date) {
  $year = substr($date,0,4);
  $month = substr($date,4,2);
  $day = substr($date,6,2);
  $strMonth = '';
  switch($month):
      case "01":
          $strMonth = "January";
      break;
      
      case "02":
          $strMonth = "February";
      break;
      
      case "03":
          $strMonth = "March";
      break;
      
      case "04":
          $strMonth = "April";
      break;
      
      case "05":
          $strMonth = "May";
      break;
      
      case "06":
          $strMonth = "June";
      break;
      
      case "07":
          $strMonth = "July";
      break;
      
      case "08":
          $strMonth = "August";
      break;
      
      case "09":
          $strMonth = "September";
      break;
      
      case "10":
          $strMonth = "October";
      break;
      
      case "11":
          $strMonth = "November";
      break;
      
      case "12":
          $strMonth = "December";
      break;
      
  endswitch;
  
  return $strMonth . ' ' . $day .',' . ' ' . $year;
}
}

if ( ! function_exists( 'stepconference_scripts' ) ) {
    function stepconference_scripts() {
        
        //wp_deregister_script( 'jquery-core' );
         //wp_register_script( 'jquery-core', "https://code.jquery.com/jquery-3.1.1.min.js", array(), '3.1.1' );
         //wp_deregister_script( 'jquery-migrate' );
         //wp_register_script( 'jquery-migrate', "https://code.jquery.com/jquery-migrate-3.0.0.min.js", array(), '3.0.0' );
        /* Register scripts in the header */
        wp_register_script( 'modernizr-js', THEMEROOT . '/app/js/modernizr.custom.js','', false, false );
        wp_register_script( 'emulation-js', THEMEROOT . '/app/js/ie-emulation-modes-warning.js','', false, false );
        
        
        /* Register scripts in the footer */

        wp_register_script( 'tether-js', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', array( 'jquery' ), false, false );
        wp_register_script( 'bootstrap-js', THEMEROOT . '/app/js/bootstrap.min.js', array( 'jquery' ), false, false );
        wp_register_script( 'viewport-bug-js', THEMEROOT . '/app/js/ie10-viewport-bug-workaround.js', array( 'jquery' ), false, false );
        
        wp_register_script( 'selectric-js', THEMEROOT . '/app/js/jquery.selectric.min.js', array( 'jquery' ), false, false );
        
        wp_register_script( 'mask-js', THEMEROOT . '/app/js/jquery.mask.min.js', array( 'jquery' ), false, false );
        wp_register_script( 'datepicker-js', 'https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js',array('jquery'),false,false);
        wp_register_script( 'autosize-js', THEMEROOT . '/app/js/autosize.min.js', array( 'jquery'),false,false);
        wp_register_script( 'validate-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js', array( 'jquery' ), false, false );
        wp_register_script( 'validatemethod-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js', array( 'jquery' ), false, false );
        wp_register_script( 'app-js', THEMEROOT . '/app/js/app.js', array( 'jquery' ), false, false );
        wp_register_script( 'forms-js', THEMEROOT . '/app/js/forms.js', array( 'jquery' ), true, false );
        wp_register_script( 'new-app-js', THEMEROOT . '/app/js/new-app.js', array( 'jquery' ), true, false );
        /* Load the custom scripts. */
        wp_enqueue_script( 'modernizr-js' );
        wp_enqueue_script( 'emulation-js' );

        wp_enqueue_script( 'tether-js' );
        wp_enqueue_script( 'bootstrap-js' );
        wp_enqueue_script( 'viewport-bug-js' );
        wp_enqueue_script( 'selectric-js' );
        
        wp_enqueue_script( 'mask-js' );
        /*wp_enqueue_script( 'datepicker-js' );*/
        wp_enqueue_script( 'autosize-js' );
        wp_enqueue_script( 'validate-js' );
        wp_enqueue_script( 'validatemethod-js' );
        wp_enqueue_script( 'app-js' );
       wp_enqueue_script( 'forms-js' );
       wp_enqueue_script( 'new-app-js' );
        /* Load the stylesheets. */
        wp_enqueue_style( 'bootstrap-css', THEMEROOT . '/app/css/bootstrap.min.css' );
        wp_enqueue_style( 'default-css', THEMEROOT . '/app/css/default.css' );
        wp_enqueue_style( 'component-css', THEMEROOT . '/app/css/component.css' );
        wp_enqueue_style( 'selectric-css', THEMEROOT . '/app/css/selectric.css' );
        wp_enqueue_style( 'datepicker-css', 'https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css' );
        wp_enqueue_style( 'style-css', THEMEROOT . '/app/css/styles.css' );
        wp_enqueue_style( 'print-css', THEMEROOT . '/app/css/print.css' );
        wp_enqueue_style( 'fontawesome-css', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
        wp_enqueue_style( 'new-style-css', THEMEROOT . '/app/css/new-style.css'  );

    }

    add_action( 'wp_enqueue_scripts',  'stepconference_scripts');
}



/* ------------------------------------------------ */
/* 7. WIDGETS */
/* ------------------------------------------------ */
//require_once( get_template_directory() . '/include/widgets/widget-recent-projects.php' );



/* ------------------------------------------------ */
/* 8. VALIDATE FIELD LENGTH  */
/* ------------------------------------------------ */
/*if ( ! function_exists( 'stepconference_validate_length' ) ) {
	function stepconference_validate_length( $fieldValue, $minLength ) {
		return ( strlen( trim( $fieldValue ) ) > $minLength );
	}
}*/

function get_stepconference_logo() {
    return kirki_get_option('tg_retina_logo');
}

class description_walker extends Walker_Nav_Menu {
     function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"submenu\" style=\"position:absolute;left:0;top:35px\">\n";
  }
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        global $cnt;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
        $class_names = $value = '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
 
        //$output .= $indent . '<li><div class="submenu-item">';
 
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
        $addedIcon = '';
        if($depth != 0) {
            $description = $append = $prepend = "";
        }
        if($depth == 0)  {
            $cnt++;
            if($cnt>1) {
                $item_output .= '</ul>
          </div>
          </div></li>';
            }
            if($item->ID) {
                $item_output .= '<li><div class="submenu-item">'.apply_filters( 'the_title', $item->title, $item->ID ).'<a class="chevron-btn"><i class="fa fa-chevron-down" aria-hidden="true"></i></a><div class="submenu-container">
            <ul class="navcls'.$cnt.'">';
            }
            
        }
        if($depth > 0) {
            $item_output .='<li><a'. $attributes .'>';
            $item_output .=$args->link_before .apply_filters( 'the_title', $item->title, $item->ID ) .'</a></li>';
        }
 
        
        //$item_output .= '<a'. $attributes .'>';
        //$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        //$item_output .= $description.$args->link_after;
        //$item_output .= $addedIcon . '</a>';
        //$item_output .= $args->after;
 
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// fix for mobile
class mobile_walker2 extends Walker_Nav_Menu {
     function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"submenu\">\n";
  }
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        global $cnt3;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
        $class_names = $value = '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
 
        //$output .= $indent . '<li><div class="submenu-item">';
 
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= $class_names;
      
        if($item->url=='#myModal')
	{
        $attributes .= 'data-toggle="modal" data-target="#myModal"';
	}
        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
        $addedIcon = '';
        if($depth != 0) {
            $description = $append = $prepend = "";
        }
        if($depth == 0)  {
            $cnt3++;
            if($cnt3>1) {
                $item_output .= '</ul>
          </div>
          </div></li>';
            }
            if($item->ID) {
                $item_output .= '<li><a'. $attributes .' style="font-size:1em"><div class="submenu-item js-mobile-submenu-item">' . apply_filters( 'the_title', $item->title, $item->ID ) .'</a><div class="submenu-container"><ul class="submenu">';
            }
            
        }
        if($depth > 0) {
            $item_output .='<li><a'. $attributes .'>';
            $item_output .=$args->link_before .apply_filters( 'the_title', $item->title, $item->ID ) .'</a></li>';
        }
 
        
        //$item_output .= '<a'. $attributes .'>';
        //$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        //$item_output .= $description.$args->link_after;
        //$item_output .= $addedIcon . '</a>';
        //$item_output .= $args->after;
 
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class mobile_walker extends Walker_Nav_Menu {
     function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"submenu\">\n";
  }
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        global $cnt3;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
        $class_names = $value = '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
 
        //$output .= $indent . '<li><div class="submenu-item">';
 
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
        $addedIcon = '';
        if($depth != 0) {
            $description = $append = $prepend = "";
        }
        if($depth == 0)  {
            $cnt3++;
            if($cnt3>1) {
                $item_output .= '</ul>
          </div>
          </div></li>';
            }
            if($item->ID) {
                $item_output .= '<li><div class="submenu-item js-mobile-submenu-item">' . apply_filters( 'the_title', $item->title, $item->ID ) .'<a class="chevron-btn"><i class="fa fa-chevron-down" aria-hidden="true"></i></a><div class="submenu-container"><ul class="submenu">';
            }
            
        }
        if($depth > 0) {
            $item_output .='<li><a'. $attributes .'>';
            $item_output .=$args->link_before .apply_filters( 'the_title', $item->title, $item->ID ) .'</a></li>';
        }
 
        
        //$item_output .= '<a'. $attributes .'>';
        //$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        //$item_output .= $description.$args->link_after;
        //$item_output .= $addedIcon . '</a>';
        //$item_output .= $args->after;
 
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class socialmedia_walker extends Walker_Nav_Menu {
     function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"submenu\">\n";
  }
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        global $cnt2;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
        $class_names = $value = '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
 
        //$output .= $indent . '<li><div class="submenu-item">';
 
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
        $addedIcon = '';
        if($depth != 0) {
            $description = $append = $prepend = "";
        }
        if($depth == 0)  {
                $title = apply_filters( 'the_title', $item->title, $item->ID );
            
               $item_output .= '<li><a'. $attributes .' target="_blank"><div class="dot"><i class="fa fa-'.$title.'"></i></div></a></li>';
            
        }
        
 
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class footer_walker extends Walker_Nav_Menu {
     function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"submenu\">\n";
  }
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        global $cnt2;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
        $class_names = $value = '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
 
        //$output .= $indent . '<li><div class="submenu-item">';
 
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= $class_names;
        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
        $addedIcon = '';
        if($depth != 0) {
            $description = $append = $prepend = "";
        }
        if($depth == 0)  {
                $title = apply_filters( 'the_title', $item->title, $item->ID );
            
               $item_output .= '<li><a'. $attributes .'">'.$title.'</a></li>';
            
        }
        
 
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

add_filter( 'wpcf7_autop_or_not', '__return_false' );



