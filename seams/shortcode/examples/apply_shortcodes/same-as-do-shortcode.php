<?php
// apply_shortcodes() is do_shortcode() under a clearer name.
function guide_hello_shortcode() {
	return 'Hello';
}
add_shortcode( 'greet', 'guide_hello_shortcode' );
return apply_shortcodes( '[greet]' );
