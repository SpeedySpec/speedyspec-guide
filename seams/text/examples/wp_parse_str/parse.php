<?php
// parse_str() into the second argument, then wp_parse_str filters the array.
function guide_add_parsed_value( $result ) {
	return $result + array( 'added' => '1' );
}
add_filter( 'wp_parse_str', 'guide_add_parsed_value' );
wp_parse_str( 'a=1&b[]=2', $result );
return $result;
