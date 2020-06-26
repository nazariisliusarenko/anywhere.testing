    <!-- Right Navigation added -->
    <style>
	/* fix for schedule */
.schedule-tabs {
    height: auto!important;
}
	/* end fix */
        #menuToggle
{
  display: block;
  position: absolute;
  top: 50px;
  right: 50px;

  z-index: 9999999999999999;
  
  -webkit-user-select: none;
  user-select: none;
}

#menuToggle input
{
  display: block;
  width: 40px;
  height: 32px;
  position: absolute;
  top: -7px;
  left: -5px;
  
  cursor: pointer;
  
  opacity: 0; /* hide this */
  z-index: 2; /* and place it over the hamburger */
  
  -webkit-touch-callout: none;
}

/*
 * Just a quick hamburger
 */
#menuToggle span
{
  display: block;
  width: 33px;
  height: 4px;
  margin-bottom: 5px;
  position: relative;
  
  background: #fff;
  border-radius: 3px;
  
  z-index: 1;
  
  transform-origin: 4px 0px;
  
  transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
              background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
              opacity 0.55s ease;
}

#menuToggle span:first-child
{
  transform-origin: 0% 0%;
}

#menuToggle span:nth-last-child(2)
{
  transform-origin: 0% 100%;
}

/* 
 * Transform all the slices of hamburger
 * into a crossmark.
 */
#menuToggle input:checked ~ span
{
  opacity: 1;
  transform: rotate(45deg) translate(-2px, -1px);
  background: #232323;
}

/*
 * But let's hide the middle one.
 */
#menuToggle input:checked ~ span:nth-last-child(3)
{
  opacity: 0;
  transform: rotate(0deg) scale(0.2, 0.2);
}

/*
 * Ohyeah and the last one should go the other direction
 */
#menuToggle input:checked ~ span:nth-last-child(2)
{
  opacity: 1;
  transform: rotate(-45deg) translate(0, -1px);
}

/*
 * Make this absolute positioned
 * at the top left of the screen
 */
#menu
{
  position: absolute;
  width: 300px;
  margin: -100px 0 0 0;
  padding: 50px;
  padding-top: 125px;
  right: -100px;
  height:1000px;
  background: #fff;
  list-style-type: none;
  -webkit-font-smoothing: antialiased;
  /* to stop flickering of text in safari */
  
  transform-origin: 0% 0%;
  transform: translate(100%, 0);
  
  transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0);
}

#menu li
{
  padding: 10px 0;
  font-size: 22px;
}

/*
 * And let's fade it in from the left
 */
#menuToggle input:checked ~ ul
{
  transform: scale(1.0, 1.0);
  opacity: 1;
}
    </style>
<!--<nav role='navigation'>-->
<!--    --><?php
//    $default = array(
//        'theme_location'  => 'rightmenu',
//        'menu'            => 'rightmenu',
//        'echo'            => true,
//        'depth'           => 0,
//        'walker'          => new footer_walker
//    );
//    $my_menu = wp_get_nav_menu_object( 'rightmenu' );
//    if ($my_menu->count > 0) {
//        echo '<div id="menuToggle">
//    <!--
//    A fake / hidden checkbox is used as click reciever,
//    so you can use the :checked selector on it.
//    -->
//    <input type="checkbox" />
//
//    <!--
//    Some spans to act as a hamburger.
//
//    They are acting like a real hamburger,
//    not that McDonalds stuff.
//    -->
//    <span></span>
//    <span></span>
//    <span></span>
//
//    <!--
//    Too bad the menu has to be inside of the button
//    but hey, it\'s pure CSS magic.
//    -->
//    <ul id="menu">'?><!-- --><?php //wp_nav_menu($default); ?><!----><?php //echo '
//
//    </ul>
//  </div>';
//    }  ?>
<!--</nav>-->
    <!-- End right navigation -->