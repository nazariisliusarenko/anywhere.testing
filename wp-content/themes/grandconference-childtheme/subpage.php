<?php
require_once('../../../wp-config.php');
$post_id = $_GET["id"];
$company  = get_post_meta($post_id , 'company', true);
$content  = get_post_meta($post_id , 'content', true);
$fullcol = str_word_count($content);
$eacchcol = round($fullcol /2);
$words = split(" ", $content);
$firstrow = '';
$secondrow = '';
for($i==0;$i<$eacchcol;$i++) {
            $firstrow .= $words[$i] . ' ';
        }
 for($i==$eacchcol;$i<=$fullcol;$i++) {
            $secondrow .= $words[$i] . ' ';
        }
echo '<div class="container subpage">
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <h2>'.get_post_field('post_title', $post_id).'</h2>
        <h3>'.$company.'</h3>
        <p>'.$firstrow.'</p>
      </div>
      
      <div class="col-md-6 col-sm-12">
       <p>'.$secondrow.'</p>
        
      </div>
    </div>
    
  </div>';
