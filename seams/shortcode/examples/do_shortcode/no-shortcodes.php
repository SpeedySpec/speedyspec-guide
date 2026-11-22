<?php
// Content with no [ is returned untouched.
function guide_hello_shortcode() {
	return 'Hello';
}
add_shortcode( 'greet', 'guide_hello_shortcode' );
return do_shortcode( 'plain text' );
