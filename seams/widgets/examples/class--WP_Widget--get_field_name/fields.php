<?php
// A widget's form field names and IDs carry its ID base and number; nested names keep their brackets.
$widget = $GLOBALS['wp_widget_factory']->get_widget_object( 'text' );
$widget->_set( 3 );
return array( $widget->get_field_name( 'title' ), $widget->get_field_name( 'tags[]' ), $widget->get_field_id( 'title' ), $widget->get_field_id( 'tags[]' ) );
