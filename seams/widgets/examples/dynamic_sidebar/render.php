<?php
// Prints a sidebar's widgets (by ID, number, or name), each wrapped in the sidebar's markup with its ID and class filled in; returns whether one printed. dynamic_sidebar_params filters each widget's arguments; dynamic_sidebar_before, dynamic_sidebar and dynamic_sidebar_after fire.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
// Widget settings are saved first, then each widget registers its saved instances, as at widgets_init.
update_option( 'widget_search', array( 2 => array( 'title' => 'Find' ), '_multiwidget' => 1 ) );
update_option( 'widget_text', array( 3 => array( 'title' => 'Hi', 'text' => 'Hello there' ), '_multiwidget' => 1 ) );
wp_set_sidebars_widgets( array( 'side' => array( 'search-2', 'text-3' ), 'wp_inactive_widgets' => array() ) );
foreach ( $GLOBALS['wp_widget_factory']->widgets as $widget ) { $widget->_register(); }
function guide_print_dynamic_sidebar_before( $index, $has_widgets ) {
	echo "<!-- before $index -->";
}
add_action( 'dynamic_sidebar_before', 'guide_print_dynamic_sidebar_before', 10, 2 );
$html = guide_render( fn() => dynamic_sidebar( 'Side' ) );
return array( $html, dynamic_sidebar( 'empty' ) );
