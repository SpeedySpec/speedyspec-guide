<?php
// Whether a post ID is a menu item (post type nav_menu_item).
$item = wp_update_nav_menu_item( wp_create_nav_menu( 'Main' ), 0, array( 'menu-item-title' => 'Home', 'menu-item-url' => 'http://example.org/' ) );
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About' ) );
return array( is_nav_menu_item( $item ), is_nav_menu_item( $page ), is_nav_menu_item( 999 ), is_nav_menu_item( new WP_Error() ) );
