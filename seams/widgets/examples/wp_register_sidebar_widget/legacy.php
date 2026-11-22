<?php
// Registers a widget the old way, by ID and output callback; wp_widget_description() gives its description, escaped. An empty callback removes it.
function guide_legacy_widget( $args ) { echo $args['before_widget'], 'Legacy', $args['after_widget']; }
function guide_print_registered_widget( $widget ) {
	echo "wp_register_sidebar_widget {$widget['id']}\n";
}
add_action( 'wp_register_sidebar_widget', 'guide_print_registered_widget' );
wp_register_sidebar_widget( 'Legacy', 'Legacy', 'guide_legacy_widget', array( 'description' => '<b>Old</b> style' ) );
$desc = wp_widget_description( 'legacy' );
wp_register_sidebar_widget( 'legacy', 'Legacy', '' );
return array( $desc, isset( $GLOBALS['wp_registered_widgets']['legacy'] ) );
