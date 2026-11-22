<?php
// The widget IDs in each sidebar, from the sidebars_widgets option (cached outside the admin), without its array_version; sidebars_widgets filters it.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
// Widget settings are saved first, then each widget registers its saved instances, as at widgets_init.
update_option( 'widget_search', array( 2 => array( 'title' => 'Find' ), '_multiwidget' => 1 ) );
update_option( 'widget_text', array( 3 => array( 'title' => 'Hi', 'text' => 'Hello there' ), '_multiwidget' => 1 ) );
wp_set_sidebars_widgets( array( 'side' => array( 'search-2', 'text-3' ), 'wp_inactive_widgets' => array() ) );
foreach ( $GLOBALS['wp_widget_factory']->widgets as $widget ) { $widget->_register(); }
function guide_add_extra_sidebar( $sidebars_widgets ) {
	return $sidebars_widgets + array( 'extra' => array() );
}
add_filter( 'sidebars_widgets', 'guide_add_extra_sidebar' );
return wp_get_sidebars_widgets();
