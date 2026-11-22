<?php
// The menu locations controller lists the theme's menu locations at /wp/v2/menu-locations, each with its description and assigned menu.
register_nav_menus( array( 'primary' => 'Primary', 'footer' => 'Footer' ) );
$menu = wp_create_nav_menu( 'Main' );
set_theme_mod( 'nav_menu_locations', array( 'primary' => $menu ) );
$locations = guide_rest( 'GET', '/wp/v2/menu-locations' )[1];
return array( array_keys( $locations ), $locations['primary']['menu'] === $menu, $locations['footer']['menu'] );
