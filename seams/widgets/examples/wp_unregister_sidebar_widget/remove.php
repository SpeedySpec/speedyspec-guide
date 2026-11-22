<?php
// Removes an old-style widget and its control; wp_unregister_sidebar_widget fires first.
function guide_legacy_widget() {}
wp_register_sidebar_widget( 'legacy', 'Legacy', 'guide_legacy_widget' );
wp_register_widget_control( 'legacy', 'Legacy', 'guide_legacy_widget' );
add_action( 'wp_unregister_sidebar_widget', fn( $id ) => print( "wp_unregister_sidebar_widget $id\n" ) );
wp_unregister_sidebar_widget( 'legacy' );
return array( isset( $GLOBALS['wp_registered_widgets']['legacy'] ), isset( $GLOBALS['wp_registered_widget_controls']['legacy'] ) );
