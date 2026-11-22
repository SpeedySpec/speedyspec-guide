<?php
// Creates the admin bar when it is showing: wp_admin_bar_class picks the class, then it is initialized and its menus hooked.
guide_log_in( array( 'read' => true ) );
function guide_print_admin_bar_init() {
	echo "admin_bar_init\n";
}
add_action( 'admin_bar_init', 'guide_print_admin_bar_init' );
function guide_print_add_admin_bar_menus() {
	echo "add_admin_bar_menus\n";
}
add_action( 'add_admin_bar_menus', 'guide_print_add_admin_bar_menus' );
$ok = _wp_admin_bar_init();
return array( $ok, get_class( $GLOBALS['wp_admin_bar'] ), has_action( 'admin_bar_menu', 'wp_admin_bar_site_menu' ) );
