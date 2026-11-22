<?php
// The classic menu to fall back to: the one at the primary location, else one named primary, else the newest.
wp_create_nav_menu( 'Footer' );
$primary = wp_create_nav_menu( 'Main' );
set_theme_mod( 'nav_menu_locations', array( 'primary' => $primary ) );
return block_core_navigation_get_classic_menu_fallback()->name;
