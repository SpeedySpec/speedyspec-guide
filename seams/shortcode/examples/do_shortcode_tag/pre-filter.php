<?php
// A value other than false from pre_do_shortcode_tag replaces the shortcode without running its callback.
add_shortcode( 'greet', function () { echo 'ran '; return 'Hello'; } );
function guide_skip_greet_shortcode( $return, $tag ) {
	return 'greet' === $tag ? 'Skipped' : $return;
}
add_filter( 'pre_do_shortcode_tag', 'guide_skip_greet_shortcode', 10, 2 );
return do_shortcode( '[greet]' );
