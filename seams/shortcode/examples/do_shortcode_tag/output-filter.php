<?php
// do_shortcode_tag filters the callback's output.
add_shortcode( 'greet', fn() => 'Hello' );
function guide_bold_shortcode_output( $output ) {
	return "<b>$output</b>";
}
add_filter( 'do_shortcode_tag', 'guide_bold_shortcode_output' );
return do_shortcode( '[greet]' );
