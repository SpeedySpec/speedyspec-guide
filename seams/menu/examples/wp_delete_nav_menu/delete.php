<?php
// Deletes a menu, its items and its term, and unassigns it from its locations; wp_delete_nav_menu fires with its ID. A missing menu gives false.
function guide_report_deleted_menu( $id ) {
	echo "wp_delete_nav_menu $id\n";
}
add_action( 'wp_delete_nav_menu', 'guide_report_deleted_menu' );
$menu = wp_create_nav_menu( 'Main' );
$item = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Home', 'menu-item-url' => 'http://example.org/' ) );
set_theme_mod( 'nav_menu_locations', array( 'primary' => $menu, 'footer' => 7 ) );
$deleted = wp_delete_nav_menu( $menu );
return array( $deleted, get_post( $item ), get_term( $menu, 'nav_menu' ), get_nav_menu_locations(), wp_delete_nav_menu( 'nope' ) );
