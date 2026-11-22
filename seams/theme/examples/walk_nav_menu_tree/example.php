<?php
// Walks menu items with the menu's walker, Walker_Nav_Menu by default.
register_nav_menus( array( 'primary' => 'Primary' ) );
$menu = wp_create_nav_menu( 'Main' );
$page = wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
$item = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'About us', 'menu-item-object' => 'page', 'menu-item-object-id' => $page, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Team', 'menu-item-url' => 'http://example.org/team', 'menu-item-parent-id' => $item, 'menu-item-status' => 'publish' ) );
set_theme_mod( 'nav_menu_locations', array( 'primary' => $menu ) );
$items = wp_get_nav_menu_items( $menu );
return substr_count( walk_nav_menu_tree( $items, 0, (object) array( 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'walker' => '' ) ), '<li' );
