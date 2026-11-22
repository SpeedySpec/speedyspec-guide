<?php
// Sends a redirect to a location, 302 by default; wp_redirect and wp_redirect_status filter them before the location is sanitized, and false from either stops it. A status that isn't 3xx ends the request.
$bad = guide_dies( fn() => wp_redirect( '/x', 200 ) );
function guide_print_and_stop_redirect( $location, $status ) {
	echo "$status to $location\n";
	return false;
}
add_filter( 'wp_redirect', 'guide_print_and_stop_redirect', 10, 2 );
return array( wp_redirect( 'https://example.org/a', 301 ), $bad['message'] );
