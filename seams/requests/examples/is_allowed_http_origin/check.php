<?php
// An origin when allowed, else ''; allowed_http_origin filters the answer.
add_filter( 'allowed_http_origin', fn( $origin, $arg ) => $origin ?: ( 'https://partner.example' === $arg ? $arg : '' ), 10, 2 );
return array( is_allowed_http_origin( 'http://example.org' ), is_allowed_http_origin( 'https://partner.example' ), is_allowed_http_origin( 'https://other.example' ) );
