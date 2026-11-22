<?php
// Whether a registered location has a menu assigned; has_nav_menu filters it.
register_nav_menus( array( 'primary' => 'Primary', 'footer' => 'Footer' ) );
set_theme_mod( 'nav_menu_locations', array( 'primary' => wp_create_nav_menu( 'Main' ), 'unregistered' => 5 ) );
$answers = array( has_nav_menu( 'primary' ), has_nav_menu( 'footer' ), has_nav_menu( 'unregistered' ) );
add_filter( 'has_nav_menu', fn( $has, $location ) => $has || 'footer' === $location, 10, 2 );
return array( $answers, has_nav_menu( 'footer' ) );
