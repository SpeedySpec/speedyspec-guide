<?php
// Matches stored widgets to the registered sidebars (wp_map_sidebars_widgets()), drops unregistered widgets, and puts registered widgets shown nowhere into the inactive widgets; saves the result unless called for the Customizer.
register_sidebar( array( 'id' => 'primary' ) );
update_option( 'widget_search', array( 2 => array(), 4 => array(), '_multiwidget' => 1 ) );
foreach ( $GLOBALS['wp_widget_factory']->widgets as $widget ) { $widget->_register(); }
$GLOBALS['sidebars_widgets'] = array( 'old-sidebar' => array( 'search-2', 'ghost-9' ) );
return retrieve_widgets( true );
