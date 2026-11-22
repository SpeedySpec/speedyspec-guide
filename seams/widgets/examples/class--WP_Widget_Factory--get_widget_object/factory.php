<?php
// The factory holds the registered widgets by class name (or object ID for registered instances); get_widget_object() and get_widget_key() find one by ID base.
$object = new WP_Widget_Search();
$GLOBALS['wp_widget_factory']->register( $object );
$keys = array_filter( array_keys( $GLOBALS['wp_widget_factory']->widgets ), fn( $k ) => str_starts_with( $k, 'spl_object_id:' ) );
return array( get_class( $GLOBALS['wp_widget_factory']->get_widget_object( 'calendar' ) ), $GLOBALS['wp_widget_factory']->get_widget_key( 'calendar' ), $GLOBALS['wp_widget_factory']->get_widget_object( 'nope' ), count( $keys ) );
