<?php
// Saves new menu items from the boxes' submitted data, as drafts, and gives their IDs.
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
$ids = wp_save_nav_menu_items( 0, array( array( 'menu-item-object-id' => $page, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-title' => 'About' ) ) );
return array( count( $ids ), get_post_status( $ids[0] ) );
