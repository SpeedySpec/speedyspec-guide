<?php
// A value other than false from pre_do_shortcode_tag replaces the shortcode without running its callback.
function guide_noisy_hello_shortcode() {
	echo 'ran ';
	return 'Hello';
}
add_shortcode( 'greet', 'guide_noisy_hello_shortcode' );
function guide_skip_greet_shortcode( $return, $tag ) {
	return 'greet' === $tag ? 'Skipped' : $return;
}
add_filter( 'pre_do_shortcode_tag', 'guide_skip_greet_shortcode', 10, 2 );
return do_shortcode( '[greet]' );
