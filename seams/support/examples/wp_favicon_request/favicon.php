<?php
// For a request for /favicon.ico, sends an empty icon and ends the request; deprecated in 5.4.0, as WordPress serves the site icon instead.
function guide_print_deprecated_function( $function, $replacement ) {
	echo "$function is deprecated for $replacement\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 2 );
wp_favicon_request();
return 'not a favicon request';
