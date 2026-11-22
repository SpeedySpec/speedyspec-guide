<?php
// Adds an Add menu items box for each taxonomy shown in menus.
set_current_screen( 'nav-menus' );
wp_nav_menu_taxonomy_meta_boxes();
return array_keys( $GLOBALS['wp_meta_boxes']['nav-menus']['side']['default'] );
