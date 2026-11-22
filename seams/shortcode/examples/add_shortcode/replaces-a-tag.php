<?php
// Registers a callback; do_shortcode() replaces the tag with what it returns.
function guide_greet_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'name' => 'you' ), $atts, 'greet' );
	return 'Hello, ' . esc_html( $atts['name'] );
}
add_shortcode( 'greet', 'guide_greet_shortcode' );
return do_shortcode( 'Say: [greet name="Ada"] and [greet]' );
