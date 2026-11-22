<?php
// Registers menu locations by slug and description and turns on the menus theme support; numeric keys are a mistake reported with _doing_it_wrong. register_nav_menu() registers one; get_registered_nav_menus() lists them.
add_action( 'doing_it_wrong_run', fn( $function ) => print( "doing_it_wrong_run $function\n" ) );
add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
register_nav_menus( array( 'primary' => 'Primary', 'footer' => 'Footer' ) );
register_nav_menu( 'social', 'Social links' );
register_nav_menus( array( 'Bad location' ) );
return array( get_registered_nav_menus(), current_theme_supports( 'menus' ) );
