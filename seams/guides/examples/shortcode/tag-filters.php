<?php
// Two filters wrap every shortcode: pre_do_shortcode_tag can answer instead of the callback, do_shortcode_tag changes its output.
function my_plugin_greet_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'name' => __( 'you', 'my-plugin' ) ), $atts, 'my_plugin_greet' );
	/* translators: %s: Who to greet. */
	return esc_html( sprintf( __( 'Hello, %s', 'my-plugin' ), $atts['name'] ) );
}
add_shortcode( 'my_plugin_greet', 'my_plugin_greet_shortcode' );

function my_other_plugin_wrap_greeting( $output, $tag ) {
	return 'my_plugin_greet' === $tag ? '<em>' . $output . '</em>' : $output;
}
add_filter( 'do_shortcode_tag', 'my_other_plugin_wrap_greeting', 10, 2 );
$wrapped = do_shortcode( '[my_plugin_greet name="Ada"]' );

function my_other_plugin_hide_greeting( $short_circuit, $tag ) {
	return 'my_plugin_greet' === $tag ? '' : $short_circuit;
}
add_filter( 'pre_do_shortcode_tag', 'my_other_plugin_hide_greeting', 10, 2 );
return array( 'wrapped' => $wrapped, 'hidden' => do_shortcode( 'Before [my_plugin_greet] after.' ) );
