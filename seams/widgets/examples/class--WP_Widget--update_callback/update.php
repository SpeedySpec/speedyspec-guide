<?php
// Saves the posted settings of one widget number through its update() (widget_update_callback filters the result, false skips it), keeping the other numbers; save_settings() adds _multiwidget.
$widget = $GLOBALS['wp_widget_factory']->get_widget_object( 'search' );
$widget->save_settings( array( 2 => array( 'title' => 'Old' ), 5 => array( 'title' => 'Other' ) ) );
function guide_mark_widget_update( $instance, $new_instance, $old_instance, $widget ) {
	return $instance + array( 'by' => 'guide' );
}
add_filter( 'widget_update_callback', 'guide_mark_widget_update', 10, 4 );
$_POST = array( 'widget-search' => array( 2 => array( 'title' => '<b>New</b>' ) ) );
$widget->update_callback();
return get_option( 'widget_search' );
