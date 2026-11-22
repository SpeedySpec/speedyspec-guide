<?php
// Every registered tag used in content, in order and repeated, including inside enclosing shortcodes.
function guide_a_shortcode() {
	return 'A';
}
function guide_b_shortcode( $atts, $content ) {
	return $content;
}
add_shortcode( 'a', 'guide_a_shortcode' );
add_shortcode( 'b', 'guide_b_shortcode' );
return get_shortcode_tags_in_content( '[a] text [b x=1][a][/b] [unregistered]' );
