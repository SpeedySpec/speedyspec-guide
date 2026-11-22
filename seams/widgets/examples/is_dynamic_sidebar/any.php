<?php
// Whether any registered sidebar shows a registered widget.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
$none = is_dynamic_sidebar();
update_option( 'widget_search', array( 2 => array(), '_multiwidget' => 1 ) );
foreach ( $GLOBALS['wp_widget_factory']->widgets as $widget ) { $widget->_register(); }
wp_set_sidebars_widgets( array( 'side' => array( 'search-2' ) ) );
return array( $none, is_dynamic_sidebar() );
