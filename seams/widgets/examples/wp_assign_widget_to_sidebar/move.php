<?php
// Moves a widget into a sidebar, at the end, removing it from any other; an empty sidebar ID only removes it.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
// Widget settings are saved first, then each widget registers its saved instances, as at widgets_init.
update_option( 'widget_search', array( 2 => array( 'title' => 'Find' ), '_multiwidget' => 1 ) );
update_option( 'widget_text', array( 3 => array( 'title' => 'Hi', 'text' => 'Hello there' ), '_multiwidget' => 1 ) );
wp_set_sidebars_widgets( array( 'side' => array( 'search-2', 'text-3' ), 'wp_inactive_widgets' => array() ) );
foreach ( $GLOBALS['wp_widget_factory']->widgets as $widget ) { $widget->_register(); }
register_sidebar( array( 'id' => 'footer' ) );
wp_assign_widget_to_sidebar( 'text-3', 'footer' );
$moved = wp_get_sidebars_widgets();
wp_assign_widget_to_sidebar( 'search-2', '' );
return array( $moved, wp_get_sidebars_widgets() );
