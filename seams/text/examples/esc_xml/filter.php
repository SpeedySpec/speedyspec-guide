<?php
// esc_xml gets the escaped text and the original.
function guide_bracket_xml( $safe, $text ) {
	return "[$safe]";
}
add_filter( 'esc_xml', 'guide_bracket_xml', 10, 2 );
return esc_xml( '"' );
