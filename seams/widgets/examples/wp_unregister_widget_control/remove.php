<?php
// Removes a widget's form and update callbacks.
wp_register_widget_control( 'legacy', 'Legacy', 'strlen' );
wp_unregister_widget_control( 'legacy' );
return array( isset( $GLOBALS['wp_registered_widget_controls']['legacy'] ), isset( $GLOBALS['wp_registered_widget_updates']['legacy'] ) );
