<?php
// Double brackets print a shortcode as text; inside an HTML tag a shortcode runs only in an attribute's value.
function my_plugin_greet_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'name' => __( 'you', 'my-plugin' ) ), $atts, 'my_plugin_greet' );
	/* translators: %s: Who to greet. */
	return esc_html( sprintf( __( 'Hello, %s', 'my-plugin' ), $atts['name'] ) );
}
add_shortcode( 'my_plugin_greet', 'my_plugin_greet_shortcode' );

return array(
	'double brackets'    => do_shortcode( 'Type [[my_plugin_greet]] to greet.' ),
	'in an attribute'    => do_shortcode( '<span title="[my_plugin_greet name=Ada]">x</span>' ),
	'ignore_html'        => do_shortcode( '<span title="[my_plugin_greet name=Ada]">x</span>', true ),
);
