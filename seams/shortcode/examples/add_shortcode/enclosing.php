<?php
// An enclosing shortcode gets its content as the second argument, and its tag as the third.
function guide_box_shortcode( $atts, $content, $tag ) {
	return '<div class="' . esc_attr( $tag ) . '">' . wp_kses_post( $content ) . '</div>';
}
add_shortcode( 'box', 'guide_box_shortcode' );
return do_shortcode( '[box]inside[/box]' );
