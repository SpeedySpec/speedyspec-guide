<?php
// Says whether a tag is registered.
function guide_hello_shortcode() {
	return 'Hello';
}
add_shortcode( 'greet', 'guide_hello_shortcode' );
return array( shortcode_exists( 'greet' ), shortcode_exists( 'other' ) );
