<?php
// Sends a redirect to a location, 302 by default; wp_redirect and wp_redirect_status filter them before the location is sanitized, and false from either stops it. A status that isn't 3xx ends the request.
$bad = guide_dies( fn() => wp_redirect( '/x', 200 ) );
add_filter( 'wp_redirect', function ( $location, $status ) { echo "$status to $location\n"; return false; }, 10, 2 );
return array( wp_redirect( 'https://example.org/a', 301 ), $bad['message'] );
