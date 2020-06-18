<?php
/*
Template Name: StepConference Company Directory
*/
get_header();

?>

<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
  <style>
  body {
    background-image:none;
    background-color:#fff;
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

.logo-agenda{

    width: 15% !important;
    height: 10% !important;
    display: inline-block;

}

.heading-company{
    font-family: bebas-bold;
    line-height: 1;
    font-style: bold;
    color: #fff;
    font-size: 30px;
    text-align: left;
    font-weight: 700;
    text-transform: uppercase;
    margin-left: 20px;
    margin-bottom: 15px;}

 .title-company{    display: inline-block;position:relative;top:5px;
}
  </style>
<section id="Schedule">
<center><h1><?= get_the_title() ?></h1></center>
<div class="schedule-tabs">
  <?php
  $idObj = get_category_by_slug('conference-agenda'); 
  $cat_id = $idObj->term_id;
  $args = array('parent' => $cat_id);
  $categories = get_categories( $args );
  ?>
<ul class="cattab">
      <li><a href="javascript:;" data-catid="all">Partner Type</a></li>
      <?php foreach($categories as $category): ?>
      <li><a href="javascript:;" data-catid="cat<?= $category->term_id ?>"><?= $category->name ?></a></li>
      <?php endforeach; ?>
    </ul>
</div>

<br/>

<div class="schedule-tabs session-tabs">
  <?php
  $idObj = get_category_by_slug('sessions'); 
  $cat_id = $idObj->term_id;
  $args = array('parent' => $cat_id);
  $sessions = get_categories( $args );
  ?>
<ul class="sessiontab">
      <li><a href="javascript:;" data-sessionid="all">Industry</a></li>
      <?php
      foreach( $sessions as $session ):
      ?>
      <li><a href="javascript:;" data-sessionid="session<?= $session->term_id ?>"><?= $session->name ?></a></li>
      <?php
      endforeach;
      ?>
    </ul>
</div>


<br/>

<div class="days-tabs" style="display:none;>
<ul class="daytab">
      <li style="display:none;"><a href="javascript:;" data-day="all">All Days</a></li>
      <?php
       $recent_posts = wp_get_recent_posts( array(
        'numberposts' => -1,
        'post_type' => 'sessions',
        'post_status' => 'publish',
        'order'     => 'DESC',
        'orderby'   => 'meta_value', //or 'meta_value_num'
        'meta_query' => array(
                    array('key' => 'day', 'key' => 'start_time'))
    ));
      $cnt = [];
      $cntval = 1;
      $liste = array();
      foreach( $recent_posts as $recent ):
        // condition of fix to make single dates instead of repeating dates
        $value = get_post_meta($recent["ID"],'day',true);
        
        if(!in_array($value, $liste, true)):
        array_push($liste, $value);
        
        $cnt[$cntval - 1] = $value;
             $category = get_the_category( $recent["ID"] );
             
     $catlist = '';
     $catclass = '';
    foreach($categories as $maincat): 
      foreach ( $category as $cat){
        if($maincat->term_id == $cat->term_id):
        $catclass = 'cat'.$cat->term_id;
        break 2;
        endif;
        
      }
    endforeach;
        foreach($sessions as $mainsess): 
      foreach ($category as $cat){
        if($mainsess->term_id == $cat->term_id):
        $sessclass = 'session'.$cat->term_id;
        break 2;
        endif;
        
      }
    endforeach;
      ?>
      <li class="<?= $catclass ?> <?= $sessclass ?>"><a href="javascript:;" data-day="day<?= $value ?>">Day <?= $cntval ?></a>&nbsp;<span class="date"><?= formatDate(get_post_meta($recent["ID"],'day',true)) ?></span></li>
      <?php
      $cntval++;
      
      endif; // end added condition
      
      endforeach;
      
      ?>
    </ul>
</div>




<br/>
<div id="accordion">
<?php
$cnt = [];
$cntval = 0;
$liste = array();
   foreach( $recent_posts as $recent ):
     // fix for the days filter;
        // condition of fix to make single dates instead of repeating dates
        //echo $recent["ID"];
        $value = get_post_meta($recent["ID"],'day',true);
         
        if(!in_array($value, $liste, true)):
        array_push($liste, $value);
        $cnt[$cntval - 1] = $value;
        $cntval++;
        endif;
     $category = get_the_category( $recent["ID"] );
     $catlist = '';
     $catclass = '';
     $sessclass = '';
    foreach($categories as $maincat): 
      foreach ( $category as $cat){
        if($maincat->term_id == $cat->term_id):
        $color = get_term_meta( $cat->term_id, 'bgcolor', true );
        $catlist = '<span class="label orange" style="background-color:'.$color.'">'.$cat->name.'</span>';
        $catclass = 'cat'.$cat->term_id;
        break;
        endif;
      }
    endforeach; //first for each;
  
    foreach($sessions as $mainsess): 
      foreach ( $category as $cat){
        if($mainsess->term_id == $cat->term_id):
        $sessclass = 'session'.$cat->term_id;
        break 2;
        endif;
        
      }
    endforeach;

?>
<!-- start schedule row -->
<div class="schedule-row <?= $catclass ?> day<?= $value ?> <?=  $sessclass ?>" data-date="<?= gmdate('D, d M Y', strtotime(get_post_meta($recent["ID"],'day',true))) ?> <?= date("H:i:s", strtotime(get_post_meta($recent["ID"],'start_time',true) . " GMT")) ?> GMT">
  <ul>
    <li style="display:none;"><div class="icon-calendar">&nbsp;</div><?= formatDate(get_post_meta($recent["ID"],'day',true)) ?></li>
    <li style="display:none;"><div class="icon-clock-o">&nbsp;</div><?= date("g:i a", strtotime(get_post_meta($recent["ID"],'start_time',true) . " UTC")) ?></li>
    <li><div class="icon-map-pin-streamline">&nbsp;</div><?= get_post_meta($recent["ID"],'location',true) ?></li>
    <li><?= $catlist ?></li>
  </ul>
  <!-- start schedule subject -->
  <div class="schedule-subject">
    <img src="<?= get_the_post_thumbnail_url($recent["ID"], 'logo') ?>" class="logo-agenda" />

    <h2 class="title-company"><?= $recent["post_title"] ?></h2>


    <p><?= wp_trim_words( strip_shortcodes( strip_tags( $recent["post_content"] ) ), 20 ) ?></p>
  </div> <!-- end schedule subject -->
  <!-- start schedule content -->
  <div class="schedule-content">

    <ul>
      <li style="display:none;"><?= date("g:i a", strtotime(get_post_meta($recent["ID"],'start_time',true) . " UTC")) ?></li>
      <li style="display:none;"><?= date("g:i a", strtotime(get_post_meta($recent["ID"],'end_time',true) . " UTC")) ?></li>
      <li><?= get_post_meta($recent["ID"],'location',true) ?></li>
    </ul>

    <h2 class="heading-company"><?= $recent["post_title"] ?></h2>

    <p><?= $recent["post_content"] ?></p>
    <ul>
      <?php
      if(!empty(get_post_meta($recent["ID"],'speaker',true))){
        $speakers = get_post_meta($recent["ID"],'speaker',true);
        foreach($speakers as $speakerid):
        $speaker = get_post($speakerid);
          ?>
           <li>
        <img src="<?= get_the_post_thumbnail_url($speakerid, 'post-thumbnail') ?>" />
        <div>
        <span class="title"><?= $speaker->post_title ?></span>
        <span class="subtitle"><?= get_post_meta($speaker->ID,'company',true) ?></span>
        </div>
        
      </li>
          <?php
        endforeach;
      }

      ?> 
    </ul>
  </div> <!-- end schedule content -->
</div><!-- end schedule row -->
<?php


        
endforeach;
?>
  
  
</div><!-- end accordion -->
</section>
<script>

  $('document').ready(function(e){
     //fix of filter 
    $('.cattab').find('li:eq(0)').addClass('active');
    $('.sessiontab').find('li:eq(0)').addClass('active');
    $('.daytab').find('li:eq(0)').addClass('active');
    var datatab = $('.daytab');
    var firstDayListClass = datatab.find('li:eq(1)').attr('class');
    var firstDayLinkClass = datatab.find('li:eq(1)').find('a').attr('data-day');
    var firstDayLabel = datatab.find('li:eq(1)').find('span.date').text();
    var secondDayListClass = datatab.find('li:eq(2)').attr('class');
    var secondDayLinkClass = datatab.find('li:eq(2)').find('a').attr('data-day');
    var secondDayLabel = datatab.find('li:eq(2)').find('span.date').text();
    
    // spliting the days
    /*datatab.find('li:eq(1)').attr('class',secondDayListClass);
    datatab.find('li:eq(1)').find('a').attr('data-day',secondDayLinkClass);
    datatab.find('li:eq(1)').find('span.date').text(secondDayLabel);
    
    datatab.find('li:eq(2)').attr('class',firstDayListClass);
    datatab.find('li:eq(2)').find('a').attr('data-day',firstDayLinkClass);
    datatab.find('li:eq(2)').find('span.date').text(firstDayLabel);*/
    
     // sort fix for the schedule
     function sortDates(a, b)
{
    return new Date(b).getTime() - new Date(a).getTime();
}

var dates = [];
var _old;

$('.schedule-row').each(function(){
    _old = $(this).parent();
    dates.push($(this).data('date'));
});

var sorted = dates.sort(sortDates);
var _new = $('<div id="accordion">').insertBefore(_old);

$.each(sorted,function(i,val){
    $('.schedule-row[data-date="' + val + '"]').prependTo(_new);
});

_old.remove();



    var acc = $("#accordion").accordion();
  });
  
</script>
  
  

    <script src="<?= site_url() ?>/wp-content/themes/grandconference-childtheme/app/js/schedule.js"></script>

<?
get_footer();
?>

<script>
var catid = 'all';
var sessionid = 'all';
var dayid = 'all';
  $('document').ready(function(){

    $('.cattab').find('li').on('click',function(e){
      e.preventDefault();
      sessionid = 'all';
      dayid = 'all';
      $('.cattab').find('li').removeClass('active');
      $('.sessiontab').find('li').removeClass('active');
      $('.daytab').find('li').removeClass('active');
      $(this).addClass('active');
      catid = $(this).find('a').attr('data-catid');
      filter();
    });
    
    $('.sessiontab').find('li').on('click',function(e){
      e.preventDefault();
      dayid = 'all';
      $('.sessiontab').find('li').removeClass('active');
      $('.daytab').find('li').removeClass('active');
      $(this).addClass('active');
      sessionid = $(this).find('a').attr('data-sessionid');
      filter();
    });
    
    $('.daytab').find('li').on('click',function(e){
      e.preventDefault();
      $('.daytab').find('li').removeClass('active');
      $(this).addClass('active');
      dayid = $(this).find('a').attr('data-day');
      filter();
    });
    
    function filter() {
      $('#accordion').find('.schedule-row').hide();
      if(catid=='all' && sessionid=='all' && dayid=='all') {
       $('#accordion').find('.schedule-row').show();
      }
      
       if(catid=='all' && sessionid=='all' && dayid!='all') {
       $('#accordion').find('.'+dayid).show();
      }
      
      if(catid=='all' && sessionid!='all' && dayid=='all') {
       $('#accordion').find('.'+sessionid).show();
      }
      
      if(catid!='all' && sessionid=='all' && dayid=='all') {
       $('#accordion').find('.'+catid).show();
      }
      if(sessionid!='all' && catid!='all' && dayid=='all') {
       $('#accordion').find('.'+catid+'.'+sessionid).show();
      }
      
      if(dayid!='all' && sessionid=='all' && catid!='all') {
       $('#accordion').find('.'+catid+'.'+dayid).show();
      }
      
      if(dayid!='all' && sessionid!='all' && catid=='all') {
       $('#accordion').find('.'+sessionid+'.'+dayid).show();
      }
      
      if(dayid!='all' && sessionid!='all' && catid!='all') {
       $('#accordion').find('.'+catid+'.'+sessionid+'.'+dayid).show();
      }
      
    }
    
  });
</script>