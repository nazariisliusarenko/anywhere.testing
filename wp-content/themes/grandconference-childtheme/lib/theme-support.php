<?php

namespace Gutenberg_Stepconference\Theming;

add_action( 'after_setup_theme', __NAMESPACE__ . '\theme_support' );
/**
 * Enqueue theme CSS and JavaScript .
 */
function theme_support() {

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );
    

}
