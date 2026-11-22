<?php
// Fires admin_bar_menu to fill the bar, wp_before_admin_bar_render and wp_after_admin_bar_render around it, and prints it once.
guide_log_in( array( 'read' => true ) );
_wp_admin_bar_init();
remove_all_actions( 'admin_bar_menu' );
function guide_add_guide_node( $bar ) {
	$bar->add_node( array( 'id' => 'guide', 'title' => 'Guide', 'href' => '/x' ) );
}
add_action( 'admin_bar_menu', 'guide_add_guide_node' );
function guide_print_before() {
	echo "before\n";
}
add_action( 'wp_before_admin_bar_render', 'guide_print_before' );
function guide_print_after() {
	echo "after\n";
}
add_action( 'wp_after_admin_bar_render', 'guide_print_after' );
ob_start();
wp_admin_bar_render();
wp_admin_bar_render();
$html = ob_get_clean();
return array( substr_count( $html, 'id="wpadminbar"' ), str_contains( $html, "<li role='group' id='wp-admin-bar-guide'><a class='ab-item' role=\"menuitem\" href='/x'>Guide</a></li>" ), str_contains( $html, 'before' ) );
