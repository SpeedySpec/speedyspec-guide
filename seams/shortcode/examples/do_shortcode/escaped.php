<?php
// A tag in double brackets is printed as a single-bracket tag instead of being run.
function guide_hello_shortcode() {
	return 'Hello';
}
add_shortcode( 'greet', 'guide_hello_shortcode' );
return do_shortcode( '[[greet]]' );
