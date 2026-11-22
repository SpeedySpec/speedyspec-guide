<?php
// Ask whether a tag is registered or used, remove it, or strip it from text that shouldn't show shortcodes.
function my_plugin_greet_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'name' => __( 'you', 'my-plugin' ) ), $atts, 'my_plugin_greet' );
	/* translators: %s: Who to greet. */
	return esc_html( sprintf( __( 'Hello, %s', 'my-plugin' ), $atts['name'] ) );
}
add_shortcode( 'my_plugin_greet', 'my_plugin_greet_shortcode' );

$content = 'Say [my_plugin_greet name="Ada"] and [unregistered].';
$results = array(
	'exists'            => shortcode_exists( 'my_plugin_greet' ),
	'used in content'   => has_shortcode( $content, 'my_plugin_greet' ),
	'run'               => do_shortcode( $content ),
	'stripped'          => strip_shortcodes( $content ),
);
remove_shortcode( 'my_plugin_greet' );
$results['after removal'] = do_shortcode( $content );
return $results;
