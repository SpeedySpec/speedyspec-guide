<?php
// Saves a menu's submitted items, deleting those removed and publishing the drafts; gives the messages to show.
$menu = wp_create_nav_menu( 'Main' );
$item = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Docs', 'menu-item-url' => 'https://example.org/docs', 'menu-item-status' => 'publish' ) );
$_POST['menu-item-db-id'] = array( $item => $item );
$_POST['menu-item-title'] = array( $item => 'Documentation' );
$_POST['menu-item-url'] = array( $item => 'https://example.org/docs' );
$_POST['menu-item-type'] = array( $item => 'custom' );
$_POST['menu-item-object'] = array( $item => 'custom' );
$_POST['menu-item-position'] = array( $item => 1 );
wp_nav_menu_update_menu_items( $menu, 'Main' );
return get_the_title( $item );
