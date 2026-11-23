<?php
// Adds an Add menu items box for each post type shown in menus.
set_current_screen( 'nav-menus' );
wp_nav_menu_post_type_meta_boxes();
return array_keys( $GLOBALS['wp_meta_boxes']['nav-menus']['side']['default'] );
