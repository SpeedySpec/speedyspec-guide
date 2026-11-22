<?php
// Sends the HTTP status line for a code with its reason phrase (or the one given); status_header filters it.
function guide_print_status_header( $header ) {
	echo "$header\n";
	return $header;
}
add_filter( 'status_header', 'guide_print_status_header' );
status_header( 404 );
status_header( 503, 'Back soon' );
return 'sent';
