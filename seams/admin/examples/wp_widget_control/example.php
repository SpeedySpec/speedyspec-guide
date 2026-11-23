<?php
// Prints one widget's box with its form on the classic widgets screen.
register_sidebar( array( 'id' => 'sidebar-1', 'name' => 'Sidebar' ) );
$GLOBALS['sidebars_widgets'] = array( 'sidebar-1' => array( 'search-2' ) );
return str_contains( guide_render( fn() => wp_widget_control( array( 'widget_id' => 'search-2', 'widget_name' => 'Search', 'id' => 'sidebar-1' ) ) ), 'widget' );
