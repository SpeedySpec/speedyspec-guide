<?php
// Loads the posts and terms menu items point at into the cache, in one query each.
$menu = wp_create_nav_menu( 'Main' );
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
$item = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $page ) );
wp_cache_delete( $page, 'posts' );
update_menu_item_cache( array( get_post( $item ) ) );
return wp_cache_get( $page, 'posts' )->post_title;
