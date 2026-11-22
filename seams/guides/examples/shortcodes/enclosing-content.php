<?php
// An enclosing shortcode wraps content; run do_shortcode() on it so shortcodes inside still work.
function my_plugin_stars_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'count' => 3 ), $atts, 'my_plugin_stars' );
	return str_repeat( '★', min( 5, max( 1, absint( $atts['count'] ) ) ) );
}

function my_plugin_box_shortcode( $atts, $content = '' ) {
	if ( '' === trim( (string) $content ) ) {
		return '';
	}
	return '<div class="my-plugin-box">' . do_shortcode( wp_kses_post( $content ) ) . '</div>';
}

add_shortcode( 'my_plugin_stars', 'my_plugin_stars_shortcode' );
add_shortcode( 'my_plugin_box', 'my_plugin_box_shortcode' );

return array(
	'nested'   => do_shortcode( '[my_plugin_box]Great book! [my_plugin_stars count="4"][/my_plugin_box]' ),
	'scripted' => do_shortcode( '[my_plugin_box]<em>Fine</em><script>alert(1)</script>[/my_plugin_box]' ),
	'empty'    => do_shortcode( '[my_plugin_box][/my_plugin_box]' ),
);
