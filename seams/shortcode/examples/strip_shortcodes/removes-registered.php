<?php
// Removes registered shortcodes, with their content when enclosing, and leaves others.
function guide_box_shortcode( $atts, $content ) {
	return $content;
}
add_shortcode( 'box', 'guide_box_shortcode' );
return strip_shortcodes( 'a [box]inside[/box] b [unregistered] c' );
