<?php
// Prepares the menus screen: registers its Add menu items boxes and its columns.
set_current_screen( 'nav-menus' );
wp_nav_menu_setup();
return array_keys( $GLOBALS['wp_meta_boxes']['nav-menus']['side']['default'] );
