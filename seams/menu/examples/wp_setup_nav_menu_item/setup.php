<?php
// Adds the menu fields (db_id, object, type, type_label, title, url, target, classes, ...) to a menu item, or makes a post or term into an item that points at it. pre_wp_setup_nav_menu_item can answer first; wp_setup_nav_menu_item filters the result.
$page = get_post( wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) ) );
$category = get_term( wp_insert_term( 'News', 'category' )['term_id'] );
$from_page = wp_setup_nav_menu_item( $page );
$from_term = wp_setup_nav_menu_item( $category );
add_filter( 'pre_wp_setup_nav_menu_item', fn( $pre, $item ) => isset( $item->guide ) ? 'answered' : $pre, 10, 2 );
return array( array( $from_page->db_id, $from_page->type, $from_page->object, $from_page->type_label, $from_page->title, $from_page->url ), array( $from_term->type, $from_term->object, $from_term->title, $from_term->url ), wp_setup_nav_menu_item( (object) array( 'guide' => 1 ) ) );
