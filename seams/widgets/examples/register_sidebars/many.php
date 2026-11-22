<?php
// Registers several sidebars: names numbered from a %d pattern (Sidebar %d by default), ids from the id given with -2, -3 for conflicts, or sidebar-N.
register_sidebars( 3, array( 'name' => 'Footer %d', 'id' => 'footer' ) );
register_sidebars( 1 );
return array_map( fn( $s ) => $s['name'], $GLOBALS['wp_registered_sidebars'] );
