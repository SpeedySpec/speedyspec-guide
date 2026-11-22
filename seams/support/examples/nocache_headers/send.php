<?php
// Sends the headers that stop caching and drops Last-Modified; nothing once headers are sent.
add_filter( 'nocache_headers', function ( $headers ) { echo implode( ', ', array_keys( $headers ) ), "\n"; return $headers; } );
nocache_headers();
return 'sent';
