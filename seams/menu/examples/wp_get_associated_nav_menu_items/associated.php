<?php
// The IDs of the menu items that point at a post, or at a term of a taxonomy.
$menu = wp_create_nav_menu( 'Main' );
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About' ) );
$category = wp_insert_term( 'News', 'category' )['term_id'];
$to_page = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $page ) );
$to_term = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-type' => 'taxonomy', 'menu-item-object' => 'category', 'menu-item-object-id' => $category ) );
return array( wp_get_associated_nav_menu_items( $page ) === array( $to_page ), wp_get_associated_nav_menu_items( $category, 'taxonomy', 'category' ) === array( $to_term ), wp_get_associated_nav_menu_items( $category, 'taxonomy', 'post_tag' ) );
