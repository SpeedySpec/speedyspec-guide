<?php
// When a post is deleted, deletes the menu items that point at it (hooked to delete_post).
$menu = wp_create_nav_menu( 'Main' );
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About' ) );
$item = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $page ) );
_wp_delete_post_menu_item( $page );
return get_post( $item );
