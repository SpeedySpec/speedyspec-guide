<?php
// After a theme switch, sorts the widgets into the new theme's sidebars with retrieve_widgets(); it reads the sidebars_widgets global, loading it only when not yet set (here it is cleared, as in a fresh request).
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
// Widget settings are saved first, then each widget registers its saved instances, as at widgets_init.
update_option( 'widget_search', array( 2 => array( 'title' => 'Find' ), '_multiwidget' => 1 ) );
update_option( 'widget_text', array( 3 => array( 'title' => 'Hi', 'text' => 'Hello there' ), '_multiwidget' => 1 ) );
wp_set_sidebars_widgets( array( 'side' => array( 'search-2', 'text-3' ), 'wp_inactive_widgets' => array() ) );
foreach ( $GLOBALS['wp_widget_factory']->widgets as $widget ) { $widget->_register(); }
unregister_sidebar( 'side' );
register_sidebar( array( 'id' => 'sidebar-1' ) );
unset( $GLOBALS['sidebars_widgets'] );
_wp_sidebars_changed();
return get_option( 'sidebars_widgets' );
