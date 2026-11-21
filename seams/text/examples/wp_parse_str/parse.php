<?php
// parse_str() into the second argument, then wp_parse_str filters the array.
add_filter( 'wp_parse_str', fn( $result ) => $result + array( 'added' => '1' ) );
wp_parse_str( 'a=1&b[]=2', $result );
return $result;
