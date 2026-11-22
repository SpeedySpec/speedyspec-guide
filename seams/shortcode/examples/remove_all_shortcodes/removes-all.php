<?php
// Empties $shortcode_tags.
function guide_a_shortcode() {
	return 'A';
}
function guide_b_shortcode() {
	return 'B';
}
add_shortcode( 'a', 'guide_a_shortcode' );
add_shortcode( 'b', 'guide_b_shortcode' );
remove_all_shortcodes();
return $GLOBALS['shortcode_tags'];
