<?php
// When a top-level page is first published, adds it to each menu listed in the nav_menu_options option's auto_add, unless it is already there (hooked to transition_post_status).
$menu = wp_create_nav_menu( 'Main' );
update_option( 'nav_menu_options', array( 'auto_add' => array( $menu ) ) );
$page = get_post( wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) ) );
_wp_auto_add_pages_to_menu( 'publish', 'draft', $page );
_wp_auto_add_pages_to_menu( 'publish', 'draft', $page );
$child = get_post( wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Team', 'post_parent' => $page->ID, 'post_status' => 'publish' ) ) );
_wp_auto_add_pages_to_menu( 'publish', 'draft', $child );
return wp_list_pluck( wp_get_nav_menu_items( $menu ), 'title' );
