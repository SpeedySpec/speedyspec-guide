<?php
// Registers WordPress's widgets (Links only with the link manager on), then fires widgets_init.
function guide_print_widgets_init() {
	echo "widgets_init\n";
}
add_action( 'widgets_init', 'guide_print_widgets_init' );
// A fresh factory and registry, as in a new request (the setup already ran this once).
remove_action( 'widgets_init', array( $GLOBALS['wp_widget_factory'], '_register_widgets' ), 100 );
$GLOBALS['wp_widget_factory'] = new WP_Widget_Factory();
$GLOBALS['wp_registered_widgets'] = array();
wp_widgets_init();
return array_keys( $GLOBALS['wp_widget_factory']->widgets );
