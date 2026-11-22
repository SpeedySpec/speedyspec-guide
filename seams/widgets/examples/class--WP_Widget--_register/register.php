<?php
// Registers a widget for each saved number (or number 1 when none is saved): its display, update and form callbacks.
$widget = $GLOBALS['wp_widget_factory']->get_widget_object( 'archives' );
$widget->save_settings( array( 2 => array(), 7 => array() ) );
$widget->_register();
return array( isset( $GLOBALS['wp_registered_widgets']['archives-2'] ), isset( $GLOBALS['wp_registered_widgets']['archives-7'] ), $GLOBALS['wp_registered_widgets']['archives-7']['params'], isset( $GLOBALS['wp_registered_widget_controls']['archives-7'] ), isset( $GLOBALS['wp_registered_widget_updates']['archives'] ) );
