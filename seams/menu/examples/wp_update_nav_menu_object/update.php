<?php
// Creates a menu (ID 0) or updates one's name, description and parent; wp_update_nav_menu fires after an update. Another menu's name is refused.
add_action( 'wp_update_nav_menu', fn( $id, $data ) => print( "wp_update_nav_menu $id\n" ), 10, 2 );
$main = wp_update_nav_menu_object( 0, array( 'menu-name' => 'Main', 'description' => 'Top' ) );
$footer = wp_create_nav_menu( 'Footer' );
$updated = wp_update_nav_menu_object( $main, array( 'menu-name' => 'Header', 'description' => 'Site header' ) );
$term = get_term( $main, 'nav_menu' );
return array( $updated === $main, $term->name, $term->description, wp_update_nav_menu_object( $footer, array( 'menu-name' => 'Header' ) )->get_error_code() );
