<?php
// Removes a location and, with the last one gone, the menus theme support; false for an unknown location.
register_nav_menus( array( 'primary' => 'Primary', 'footer' => 'Footer' ) );
$removed = unregister_nav_menu( 'footer' );
$supports = current_theme_supports( 'menus' );
unregister_nav_menu( 'primary' );
return array( $removed, unregister_nav_menu( 'nope' ), $supports, current_theme_supports( 'menus' ), get_registered_nav_menus() );
