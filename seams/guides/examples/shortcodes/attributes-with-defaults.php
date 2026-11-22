<?php
// shortcode_atts() fills in defaults and drops attributes you didn't define; then each value is sanitized.
function my_plugin_stars_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'count' => 3,
			'label' => __( 'Rating', 'my-plugin' ),
		),
		$atts,
		'my_plugin_stars'
	);
	$count = min( 5, max( 1, absint( $atts['count'] ) ) );
	return '<span class="my-plugin-stars" aria-label="' . esc_attr( $atts['label'] . ': ' . $count ) . '">' . str_repeat( '★', $count ) . '</span>';
}
add_shortcode( 'my_plugin_stars', 'my_plugin_stars_shortcode' );

return array(
	'defaults'        => do_shortcode( '[my_plugin_stars]' ),
	'given'           => do_shortcode( '[my_plugin_stars count="5" label="Score"]' ),
	'out of range'    => do_shortcode( '[my_plugin_stars count="99"]' ),
	'unknown dropped' => do_shortcode( '[my_plugin_stars colour="red"]' ),
);
