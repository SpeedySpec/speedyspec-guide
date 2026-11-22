<?php
// Prints a button to the host's one-step PHP update, when there is one.
function guide_direct_php_update_url( $url ) {
	return 'https://host.example/update';
}
add_filter( 'wp_direct_php_update_url', 'guide_direct_php_update_url' );
return guide_render( 'wp_direct_php_update_button' );
