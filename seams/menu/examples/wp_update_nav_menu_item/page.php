<?php
// An item for a page stores the page as its object and no URL; a title equal to the page's is stored empty, so the item follows the page's title.
$menu = wp_create_nav_menu( 'Main' );
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
$item = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $page, 'menu-item-title' => 'About', 'menu-item-status' => 'publish' ) );
$items = wp_get_nav_menu_items( $menu );
return array( get_post( $item )->post_title, get_post_meta( $item, '_menu_item_url', true ), $items[0]->title, $items[0]->url, $items[0]->type_label );
