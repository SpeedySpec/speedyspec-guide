<?php
// Redirects only to the site's own host or the allowed_redirect_hosts; any other location goes to the admin (or the fallback wp_safe_redirect_fallback gives).
function guide_print_and_stop_redirect( $location ) {
	echo "to $location\n";
	return false;
}
add_filter( 'wp_redirect', 'guide_print_and_stop_redirect' );
wp_safe_redirect( 'https://evil.example/' );
wp_safe_redirect( 'http://example.org/ok' );
return 'done';
