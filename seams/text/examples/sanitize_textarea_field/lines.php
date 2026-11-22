<?php
// The same as sanitize_text_field(), keeping line breaks; sanitize_textarea_field filters it.
function guide_bracket_textarea_field( $filtered, $str ) {
	return "[$filtered]";
}
add_filter( 'sanitize_textarea_field', 'guide_bracket_textarea_field', 10, 2 );
return sanitize_textarea_field( "<b>a</b>\nb  c" );
