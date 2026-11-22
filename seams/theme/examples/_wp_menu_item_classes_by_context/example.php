<?php
// Adds the current-page classes to menu items: current-menu-item, current-menu-parent and ancestor, current_page_item and the rest, by the page queried.
register_nav_menus( array( 'primary' => 'Primary' ) );
$menu = wp_create_nav_menu( 'Main' );
$page = wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
$item = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'About us', 'menu-item-object' => 'page', 'menu-item-object-id' => $page, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Team', 'menu-item-url' => 'http://example.org/team', 'menu-item-parent-id' => $item, 'menu-item-status' => 'publish' ) );
set_theme_mod( 'nav_menu_locations', array( 'primary' => $menu ) );
guide_go( "/?page_id=$page" );
$items = wp_get_nav_menu_items( $menu );
_wp_menu_item_classes_by_context( $items );
return array( $items[0]->current, in_array( 'current-menu-item', $items[0]->classes, true ) );
