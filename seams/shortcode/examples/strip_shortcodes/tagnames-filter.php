<?php
// strip_shortcodes_tagnames chooses which registered tags are stripped.
add_shortcode( 'a', fn() => 'A' );
add_shortcode( 'b', fn() => 'B' );
function guide_strip_only_a( $tags_to_remove ) {
	return array( 'a' );
}
add_filter( 'strip_shortcodes_tagnames', 'guide_strip_only_a' );
return strip_shortcodes( '[a] [b]' );
