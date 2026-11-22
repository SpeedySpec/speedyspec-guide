<?php
// The same escaping as esc_html(), for attribute values, through attribute_escape.
function guide_bracket_attribute( $safe, $text ) {
	return "[$safe]";
}
add_filter( 'attribute_escape', 'guide_bracket_attribute', 10, 2 );
return esc_attr( '"a" & b' );
