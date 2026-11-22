<?php
// Registers the update callback for an ID base once; an empty callback removes one already set.
_register_widget_update_callback( 'guide', 'guide_update', array(), 'p' );
_register_widget_update_callback( 'guide', 'other_update' );
$kept = $GLOBALS['wp_registered_widget_updates']['guide']['callback'];
_register_widget_update_callback( 'guide', '' );
return array( $kept, isset( $GLOBALS['wp_registered_widget_updates']['guide'] ) );
