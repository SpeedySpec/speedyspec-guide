<?php
// The menus controller: navigation menus (nav_menu terms) at /wp/v2/menus, with their locations and auto-add setting; the menu items controller serves their items at /wp/v2/menu-items.
register_nav_menus( array( 'primary' => 'Primary' ) );
$menu = guide_rest( 'POST', '/wp/v2/menus', array( 'name' => 'Main', 'locations' => array( 'primary' ), 'auto_add' => true ) )[1];
$page = wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
$item = guide_rest( 'POST', '/wp/v2/menu-items', array( 'menus' => $menu['id'], 'type' => 'post_type', 'object' => 'page', 'object_id' => $page, 'status' => 'publish' ) )[1];
return array( $menu['locations'], $menu['auto_add'], $item['title']['rendered'], $item['url'], get_nav_menu_locations() );
