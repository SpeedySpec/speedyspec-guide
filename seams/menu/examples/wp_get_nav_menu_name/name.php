<?php
// The name of the menu assigned to a location, or ''; wp_get_nav_menu_name filters it.
set_theme_mod( 'nav_menu_locations', array( 'primary' => wp_create_nav_menu( 'Main Menu' ) ) );
add_filter( 'wp_get_nav_menu_name', fn( $name, $location ) => $name ?: "($location)", 10, 2 );
return array( wp_get_nav_menu_name( 'primary' ), wp_get_nav_menu_name( 'footer' ) );
