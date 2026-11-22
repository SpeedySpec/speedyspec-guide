<?php
// Sends the headers that stop caching and drops Last-Modified; nothing once headers are sent.
function guide_print_nocache_header_names( $headers ) {
	echo implode( ', ', array_keys( $headers ) ), "\n";
	return $headers;
}
add_filter( 'nocache_headers', 'guide_print_nocache_header_names' );
nocache_headers();
return 'sent';
