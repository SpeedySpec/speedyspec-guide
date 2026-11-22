<?php
// Sorts widgets by name, for the Available Widgets list.
$widgets = array( array( 'name' => 'Search' ), array( 'name' => 'Archives' ) );
usort( $widgets, '_sort_name_callback' );
return wp_list_pluck( $widgets, 'name' );
