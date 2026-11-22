<?php
// sanitize_text_field gets the result and the original.
function guide_bracket_text_field( $filtered, $str ) {
	return "[$filtered]";
}
add_filter( 'sanitize_text_field', 'guide_bracket_text_field', 10, 2 );
return sanitize_text_field( ' a ' );
