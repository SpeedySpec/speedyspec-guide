<?php
// Prints the column headers of a screen's list table, with their sorting links.
register_column_headers( 'guide-teas', array( 'name' => 'Name', 'origin' => 'Origin' ) );
$html = guide_render( fn() => print_column_headers( 'guide-teas' ) );
return array( str_contains( $html, 'column-name' ), str_contains( $html, 'column-origin' ) );
