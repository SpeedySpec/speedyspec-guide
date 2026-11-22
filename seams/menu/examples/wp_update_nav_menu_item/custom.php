<?php
// Saves a menu item: a nav_menu_item post in the menu, its type, object, URL, classes and other fields in post meta. A new custom link points at itself; its position defaults to one after the last item (0 for the first); it is a draft unless published. wp_add_nav_menu_item fires for a new item and wp_update_nav_menu_item after every save.
add_action( 'wp_add_nav_menu_item', fn( $menu, $item ) => print( "wp_add_nav_menu_item $item\n" ), 10, 2 );
add_action( 'wp_update_nav_menu_item', fn( $menu, $item ) => print( "wp_update_nav_menu_item $item\n" ), 10, 2 );
$menu = wp_create_nav_menu( 'Main' );
$first = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Home', 'menu-item-url' => ' http://example.org/ ', 'menu-item-status' => 'publish', 'menu-item-classes' => 'one two!' ) );
$second = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Blog', 'menu-item-url' => 'http://example.org/blog' ) );
$meta = get_post_meta( $first );
ksort( $meta );
return array( array_map( fn( $v ) => $v[0], $meta ), get_post( $first )->menu_order, get_post( $second )->menu_order, get_post_status( $second ), wp_get_object_terms( $first, 'nav_menu', array( 'fields' => 'ids' ) ) === array( $menu ) );
