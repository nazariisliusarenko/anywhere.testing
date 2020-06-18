<?php
/*
* Template Name: Template Gravity Form
* Template Post Type: post, page
*/
get_header();
 global $post;
 
    $post_slug=$post->post_name;
   // echo $post_slug;exit;
    if($post_slug=="step-money" || $post_slug=="step-x" || $post_slug=="step-start" || $post_slug=="step-digital" || $post_slug=="step-digital") {
        $output = "<style>
        
        .features2 h2 {
         margin-top: 70px;
        }
        
        .gform_wrapper {
    display:block!important;
}
        </style>";
        echo $output;
    }
?>
<div class="container">
     <?php
			if(have_posts()) :
   while(have_posts()) :
      the_post();
         the_content();
   endwhile;
endif;

get_footer();
?>

</div> <!-- /container -->

<!-- <script>
//gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
    // do stuff
    //optionsObj.dateFormat = 'MM d, yy';

    //return optionsObj;
//} );
</script> -->
  </body>
</html>
