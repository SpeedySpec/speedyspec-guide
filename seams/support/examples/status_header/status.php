<?php
// Sends the HTTP status line for a code with its reason phrase (or the one given); status_header filters it.
add_filter( 'status_header', function ( $header ) { echo "$header\n"; return $header; } );
status_header( 404 );
status_header( 503, 'Back soon' );
return 'sent';
