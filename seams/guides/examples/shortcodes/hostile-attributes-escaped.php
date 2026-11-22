<?php
// Attributes are typed by whoever writes the post, so escape each one for where it goes.
function my_plugin_button_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'url' => '', 'label' => __( 'Read more', 'my-plugin' ) ), $atts, 'my_plugin_button' );
	$url = esc_url( $atts['url'] );
	if ( '' === $url ) { // Missing, or refused by esc_url(): print no button rather than a broken one.
		return '';
	}
	return '<a class="button" href="' . $url . '">' . esc_html( $atts['label'] ) . '</a>';
}
add_shortcode( 'my_plugin_button', 'my_plugin_button_shortcode' );

return array(
	'normal'  => do_shortcode( '[my_plugin_button url="https://example.org/books/" label="See the books"]' ),
	'hostile' => do_shortcode( '[my_plugin_button url="javascript:alert(1)" label="<img src=x onerror=alert(1)>"]' ),
	'no url'  => do_shortcode( '[my_plugin_button]' ),
);
