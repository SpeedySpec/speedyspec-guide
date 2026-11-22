<?php
// A widget's saved instances by number, without _multiwidget; a missing option is created empty, and single-widget settings are converted.
$widget = $GLOBALS['wp_widget_factory']->get_widget_object( 'meta' );
delete_option( 'widget_meta' );
$empty = $widget->get_settings();
update_option( 'widget_meta', array( 'title' => 'Single' ) );
return array( $empty, get_option( 'widget_meta' ) === false, $widget->get_settings() );
