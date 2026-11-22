<?php
// Removes an old-style widget and its control; wp_unregister_sidebar_widget fires first.
function guide_legacy_widget() {}
wp_register_sidebar_widget( 'legacy', 'Legacy', 'guide_legacy_widget' );
wp_register_widget_control( 'legacy', 'Legacy', 'guide_legacy_widget' );
function guide_print_unregistered_widget( $id ) {
	echo "wp_unregister_sidebar_widget $id\n";
}
add_action( 'wp_unregister_sidebar_widget', 'guide_print_unregistered_widget' );
wp_unregister_sidebar_widget( 'legacy' );
return array( isset( $GLOBALS['wp_registered_widgets']['legacy'] ), isset( $GLOBALS['wp_registered_widget_controls']['legacy'] ) );
