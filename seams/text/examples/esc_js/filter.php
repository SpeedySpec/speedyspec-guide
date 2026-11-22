<?php
// js_escape gets the escaped text and the original.
function guide_join_escaped_js( $safe, $text ) {
	return "$safe|$text";
}
add_filter( 'js_escape', 'guide_join_escaped_js', 10, 2 );
return esc_js( 'a' );
