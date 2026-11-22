<?php
// A menu (a nav_menu term) by ID, slug or name, or an object passed through; false when none matches. wp_get_nav_menu_object filters the result.
$id = wp_create_nav_menu( 'Main Menu' );
function guide_fallback_menu( $menu, $arg ) {
	return $menu ?: ( 'fallback' === $arg ? (object) array( 'name' => 'Fallback' ) : false );
}
add_filter( 'wp_get_nav_menu_object', 'guide_fallback_menu', 10, 2 );
return array( wp_get_nav_menu_object( $id )->name, wp_get_nav_menu_object( 'main-menu' )->term_id, wp_get_nav_menu_object( 'Main Menu' )->slug, wp_get_nav_menu_object( 'nope' ), wp_get_nav_menu_object( 'fallback' )->name, wp_get_nav_menu_object( 0 ) );
