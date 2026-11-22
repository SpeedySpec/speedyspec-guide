<?php
// Ajax handler for the menus screen's Add to Menu: saves the chosen items as draft menu items and sends back their HTML.
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
$sent = guide_ajax( 'wp_ajax_add_menu_item', array( 'menu' => 0, 'menu-item' => array( -1 => array( 'menu-item-object-id' => $page, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-title' => 'About' ) ), 'menu-settings-column-nonce' => wp_create_nonce( 'add-menu_item' ) ) );
return str_contains( $sent, 'menu-item-title' );
