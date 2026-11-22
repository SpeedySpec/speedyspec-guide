<?php
// Whether a registered location has a menu assigned; has_nav_menu filters it.
register_nav_menus( array( 'primary' => 'Primary', 'footer' => 'Footer' ) );
set_theme_mod( 'nav_menu_locations', array( 'primary' => wp_create_nav_menu( 'Main' ), 'unregistered' => 5 ) );
$answers = array( has_nav_menu( 'primary' ), has_nav_menu( 'footer' ), has_nav_menu( 'unregistered' ) );
function guide_footer_has_menu( $has, $location ) {
	return $has || 'footer' === $location;
}
add_filter( 'has_nav_menu', 'guide_footer_has_menu', 10, 2 );
return array( $answers, has_nav_menu( 'footer' ) );
