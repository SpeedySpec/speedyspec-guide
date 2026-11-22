<?php
// The menus, as terms ordered by name, empty ones included; wp_get_nav_menus filters them.
wp_create_nav_menu( 'Main' );
wp_create_nav_menu( 'Footer' );
add_filter( 'wp_get_nav_menus', fn( $menus, $args ) => $menus, 10, 2 );
return wp_list_pluck( wp_get_nav_menus(), 'name' );
