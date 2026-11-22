<?php
// With a shortcode name, shortcode_atts_{$shortcode} can change the result.
function guide_large_greet_size( $out ) {
	$out['size'] = 'l';
	return $out;
}
add_filter( 'shortcode_atts_greet', 'guide_large_greet_size' );
return shortcode_atts( array( 'size' => 'm' ), array(), 'greet' );
