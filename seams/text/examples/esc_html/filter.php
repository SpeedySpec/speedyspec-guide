<?php
// esc_html gets the escaped text and the original.
function guide_describe_escaped_html( $safe, $text ) {
	return strlen( $safe ) . ':' . $text;
}
add_filter( 'esc_html', 'guide_describe_escaped_html', 10, 2 );
return esc_html( '<' );
