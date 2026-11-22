<?php
// Exports the map as PHP source for from_precomputed_table(), which loads it without building it again.
$map = WP_Token_Map::from_array( array( 'ab' => '1', 'abc' => '2' ) );
$source = $map->precomputed_php_source_table();
$loaded = eval( 'return ' . $source . ';' );
return array( $source, $loaded->to_array() );
