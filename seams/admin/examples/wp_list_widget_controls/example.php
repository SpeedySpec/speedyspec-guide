<?php
// Prints a widget area's widgets with their forms on the classic widgets screen.
register_sidebar( array( 'id' => 'sidebar-1', 'name' => 'Sidebar' ) );
return str_contains( guide_render( fn() => wp_list_widget_controls( 'sidebar-1', 'Sidebar' ) ), 'id="sidebar-1"' );
