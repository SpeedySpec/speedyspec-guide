<?php
// do_shortcode_tag filters the callback's output.
function guide_hello_shortcode() {
	return 'Hello';
}
add_shortcode( 'greet', 'guide_hello_shortcode' );
function guide_bold_shortcode_output( $output ) {
	return "<b>$output</b>";
}
add_filter( 'do_shortcode_tag', 'guide_bold_shortcode_output' );
return do_shortcode( '[greet]' );
