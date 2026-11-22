<?php
// A menu's published items, set up with wp_setup_nav_menu_item() and numbered 1, 2, ... in menu order; false for a menu that doesn't exist. Items for missing objects are left out. wp_get_nav_menu_items filters the list.
$menu = wp_create_nav_menu( 'Main' );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'B', 'menu-item-url' => 'http://example.org/b', 'menu-item-status' => 'publish', 'menu-item-position' => 20 ) );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'A', 'menu-item-url' => 'http://example.org/a', 'menu-item-status' => 'publish', 'menu-item-position' => 10 ) );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Draft', 'menu-item-url' => 'http://example.org/d' ) );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => 999, 'menu-item-status' => 'publish' ) );
$items = wp_get_nav_menu_items( $menu );
return array( array_map( fn( $i ) => array( $i->title, $i->menu_order ), $items ), count( wp_get_nav_menu_items( $menu, array( 'post_status' => 'publish,draft' ) ) ), wp_get_nav_menu_items( 'nope' ) );
