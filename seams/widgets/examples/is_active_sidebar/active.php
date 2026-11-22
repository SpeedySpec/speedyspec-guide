<?php
// Whether a sidebar has widgets, by ID or number; is_active_sidebar filters it.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
// Widget settings are saved first, then each widget registers its saved instances, as at widgets_init.
update_option( 'widget_search', array( 2 => array( 'title' => 'Find' ), '_multiwidget' => 1 ) );
update_option( 'widget_text', array( 3 => array( 'title' => 'Hi', 'text' => 'Hello there' ), '_multiwidget' => 1 ) );
wp_set_sidebars_widgets( array( 'side' => array( 'search-2', 'text-3' ), 'wp_inactive_widgets' => array() ) );
foreach ( $GLOBALS['wp_widget_factory']->widgets as $widget ) { $widget->_register(); }
add_filter( 'is_active_sidebar', fn( $active, $index ) => $active || 'forced' === $index, 10, 2 );
return array( is_active_sidebar( 'side' ), is_active_sidebar( 1 ), is_active_sidebar( 'forced' ) );
