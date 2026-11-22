<?php
// The sidebar where a widget is shown, found by callback, widget ID or ID base, or false; inactive and orphaned widgets are skipped unless asked.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
// Widget settings are saved first, then each widget registers its saved instances, as at widgets_init.
update_option( 'widget_search', array( 2 => array( 'title' => 'Find' ), '_multiwidget' => 1 ) );
update_option( 'widget_text', array( 3 => array( 'title' => 'Hi', 'text' => 'Hello there' ), '_multiwidget' => 1 ) );
wp_set_sidebars_widgets( array( 'side' => array( 'search-2', 'text-3' ), 'wp_inactive_widgets' => array() ) );
foreach ( $GLOBALS['wp_widget_factory']->widgets as $widget ) { $widget->_register(); }
wp_set_sidebars_widgets( array( 'side' => array( 'search-2' ), 'wp_inactive_widgets' => array( 'text-3' ) ) );
return array( is_active_widget( false, false, 'search' ), is_active_widget( false, false, 'text' ), is_active_widget( false, false, 'text', false ), is_active_widget( false, 'search-2', 'search' ) );
