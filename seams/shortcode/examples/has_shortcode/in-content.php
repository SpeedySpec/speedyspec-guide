<?php
// Says whether content uses a registered shortcode, including inside another shortcode's content.
function guide_box_shortcode( $atts, $content ) {
	return $content;
}
function guide_hello_shortcode() {
	return 'Hello';
}
add_shortcode( 'box', 'guide_box_shortcode' );
add_shortcode( 'greet', 'guide_hello_shortcode' );
return array( has_shortcode( '[box][greet][/box]', 'greet' ), has_shortcode( 'no tags', 'greet' ), has_shortcode( '[unregistered]', 'unregistered' ) );
