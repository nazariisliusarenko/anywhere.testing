<?php

namespace Gutenberg_Courses\Example_Block\Blocks\feature;


add_action( 'plugins_loaded', __NAMESPACE__ . '\register_feature_block' );
/**
 * Register the dynamic block.
 *
 * @since 2.1.0
 *
 * @return void
 */
function register_feature_block() {
	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		echo "dont' exist"; exit;
		return;
	}

	// Hook server side rendering into render callback
	register_block_type( 'jsforwpblocks/feature', [
		'render_callback' => __NAMESPACE__ . '\render_feature_block',
	] );

}

/**
 * Server rendering for /blocks/examples/12-dynamic
 */
function render_feature_block($attributes) {
    //echo "<pre>"; print_r($attributes); echo "here"; exit;
$renderImg;
if ($attributes["youtubeLink"]) {
  $renderImg = '<iframe width="100%" height="380"
src="'.$attributes["youtubeLink"].'"?controls=0" ></iframe>';
} else {
    if(isset($attributes["imgSrc"])){
        $renderImg = '<img src="'. $attributes["imgSrc"] . '"' . $attributes["imgAlt"] . '/>';
    }
    else {
        $renderImg = '<img src="'.wp_get_attachment_url( $attributes["imgID"] ) . '"/>';
    }
   
}

$renderBtn1;
$renderBtn2;
if($attributes["btnLink"]) {
        $renderBtn1  ='<div class="align-center">
                                    <a class="btn btn-md-1" href="'.$attributes["btnLink"].'">' . $attributes["btnName"] .'</a></div>';
        $renderBtn2 = '<div class="align-center">
                                    <a class="btn btn-md-2" href="'.$attributes["btnLink"].'">'.$attributes["btnName"] .'</a>
                                </div>';
}


$currentUrl ='https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
    if($currentUrl=='https://stepconference.com/vw-mobility-challenge/')
    {
      $custom="dark1";
    }


           if($attributes["imagePosition"]=="leftToRight" && $attributes["backgroundColor"]=="lightBlue") {

                   $output ='<section class="features3">
            
                 <div class="container-fluid">
                        <div class="row main align-items-center">
                            <div class="col-md-6 image-element align-self-stretch">
                                 <div class="img-wrap">'.$renderImg.'</div>
                            </div>
                            <div class="col-md-6 text-element">
                                    <h2 class="mbr-title pt-2 mbr-fonts-style align-center display-2">
                                        '.$attributes["heading"].'
                                    </h2>
                                        <p>
                                            '.$attributes["textareaDescription"].'
                                        </p>
                                   '.$renderBtn1.'
                            </div>
                          
                        </div>
                    </div>    
                    
            </section>';
            return $output;
            }
        if($attributes["imagePosition"]=="rightToLeft" && $attributes["backgroundColor"]=="lightBlue") {
            if($_SESSION['screen_width']>990){
             $output ='<section class="features4">
            <div class="container-fluid">
                    <div class="row main align-items-center">
                        <div class="col-md-5 text-element clip-right">
            
                                <h2>
                                '.$attributes["heading"].'
                                </h2>
                                
                                <p>'.$attributes["textareaDescription"].'</p>
                                '.$renderBtn1.'
                        </div>
                      
                      
                       <div class="col-md-7 image-element align-self-stretch">
                             <div class="img-wrap">
                             '.$renderImg.'
                            </div>
                        </div>
                      
                      
                      
                    </div>
                </div>    
               
            </section>';
            return $output;
            }
            else {
                $output ='<section class="features4">
            <div class="container-fluid">
                    <div class="row main align-items-center">
                    
                    <div class="col-md-7 image-element align-self-stretch">
                             <div class="img-wrap">
                             '.$renderImg.'
                            </div>
                        </div>
                        
                        <div class="col-md-5 text-element clip-right">
            
                                <h2>
                                '.$attributes["heading"].'
                                </h2>
                                
                                <p>'.$attributes["textareaDescription"].'</p>
                                '.$renderBtn1.'
                        </div>
                      
                      
                       
                      
                      
                      
                    </div>
                </div>    
               
            </section>';
            }
            return $output;
            }
   if($attributes["imagePosition"]=="rightToLeft") {
       if($_SESSION['screen_width']>990){
          $output ='<section class="features2">
                <div class="container-fluid">
                    <div class="row main align-items-center">
                        <div class="col-md-5 text-element clip-right">
            
                                <h2>
                                '.$attributes["heading"].'
                                </h2>
                                    <p>'.$attributes["textareaDescription"].'</p>
                       '.$renderBtn2.'
            
                        </div>
                      
                      
                       <div class="col-md-7 image-element align-self-stretch">
                             <div class="img-wrap">'.$renderImg.'


                            </div>
                        </div>
                      
                      
                      
                    </div>
                </div>          
            </section>';
       }
       else {
               $output ='<section class="features2">
                <div class="container-fluid">
                    <div class="row main align-items-center">
                    
                        <div class="col-md-7 image-element align-self-stretch">
                             <div class="img-wrap">'.$renderImg.'


                            </div>
                        </div>
                    
                        <div class="col-md-5 text-element clip-right">
            
                                <h2>
                                '.$attributes["heading"].'
                                </h2>
                                    <p>'.$attributes["textareaDescription"].'</p>
                       '.$renderBtn2.'
            
                        </div>
                      
                      

                      
                      
                      
                    </div>
                </div>          
            </section>';
       }
            return $output;
            }
           
            $output ='<section class="features1"> 
            
                <div class="container-fluid">
                    <div class="row main align-items-center">
                        <div class="col-md-6 image-element align-self-stretch">
                            <div class="img-wrap">

                           '.$renderImg.'


                            </div>
                        </div>
                        <div class="col-md-6 text-element">
                                <h2 class="mbr-title pt-2 mbr-fonts-style align-center display-2">
                                    '.$attributes["heading"].'
                                </h2>
                                    <p>'.$attributes["textareaDescription"].'</p>
            
                                '.$renderBtn2.'
            
                        </div>
                      
                    </div>
                </div>          
            </section>';
            
    return $output;
}
