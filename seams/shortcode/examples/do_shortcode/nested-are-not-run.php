<?php
// Shortcodes inside an enclosing shortcode's content run only if its callback calls do_shortcode() on it.
function guide_raw_shortcode( $atts, $content ) {
	return $content;
}
function guide_run_shortcode( $atts, $content ) {
	return do_shortcode( $content );
}
function guide_hello_shortcode() {
	return 'Hello';
}
add_shortcode( 'raw', 'guide_raw_shortcode' );
add_shortcode( 'run', 'guide_run_shortcode' );
add_shortcode( 'greet', 'guide_hello_shortcode' );
return array( do_shortcode( '[raw][greet][/raw]' ), do_shortcode( '[run][greet][/run]' ) );
