<?php
// strip_shortcodes_tagnames chooses which registered tags are stripped.
function guide_a_shortcode() {
	return 'A';
}
function guide_b_shortcode() {
	return 'B';
}
add_shortcode( 'a', 'guide_a_shortcode' );
add_shortcode( 'b', 'guide_b_shortcode' );
function guide_strip_only_a( $tags_to_remove ) {
	return array( 'a' );
}
add_filter( 'strip_shortcodes_tagnames', 'guide_strip_only_a' );
return strip_shortcodes( '[a] [b]' );
