<?php
// Creates a menu, a nav_menu term, and returns its ID; wp_create_nav_menu fires with it. A name already taken is refused.
add_action( 'wp_create_nav_menu', fn( $id, $data ) => print( "wp_create_nav_menu $id {$data['menu-name']}\n" ), 10, 2 );
$id = wp_create_nav_menu( 'Main' );
$term = get_term( $id, 'nav_menu' );
return array( $id, $term->name, $term->slug, wp_create_nav_menu( 'Main' )->get_error_code(), is_wp_error( wp_create_nav_menu( '' ) ) );
