<?php
// Prints (or gives) a navigation menu by location, ID, slug or name, walked by Walker_Nav_Menu inside a container; a fallback (wp_page_menu) when there is none; filtered by wp_nav_menu_args, pre_wp_nav_menu, wp_nav_menu_items and wp_nav_menu.
register_nav_menus( array( 'primary' => 'Primary' ) );
$menu = wp_create_nav_menu( 'Main' );
$page = wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
$item = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'About us', 'menu-item-object' => 'page', 'menu-item-object-id' => $page, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Team', 'menu-item-url' => 'http://example.org/team', 'menu-item-parent-id' => $item, 'menu-item-status' => 'publish' ) );
set_theme_mod( 'nav_menu_locations', array( 'primary' => $menu ) );
$html = wp_nav_menu( array( 'theme_location' => 'primary', 'echo' => false, 'container' => 'nav' ) );
return array( str_contains( $html, '<nav' ), substr_count( $html, 'menu-item ' ), str_contains( $html, 'sub-menu' ), str_contains( $html, 'menu-item-has-children' ) );
