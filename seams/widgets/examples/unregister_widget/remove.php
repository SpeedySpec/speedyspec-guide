<?php
// Removes a registered widget class, such as one of WordPress's own.
unregister_widget( 'WP_Widget_Calendar' );
return isset( $GLOBALS['wp_widget_factory']->widgets['WP_Widget_Calendar'] );
