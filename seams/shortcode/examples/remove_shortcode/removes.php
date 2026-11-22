<?php
// After removal the tag is left in the content as written.
function guide_hello_shortcode() {
	return 'Hello';
}
add_shortcode( 'greet', 'guide_hello_shortcode' );
remove_shortcode( 'greet' );
return do_shortcode( '[greet]' );
