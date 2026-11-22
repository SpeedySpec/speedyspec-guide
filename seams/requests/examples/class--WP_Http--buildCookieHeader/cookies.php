<?php
// normalize_cookies() turns name/value pairs or WP_Http_Cookie objects into a Requests cookie jar; buildCookieHeader() adds a Cookie header for the old transports.
$jar = WP_Http::normalize_cookies( array( 'a' => '1', new WP_Http_Cookie( array( 'name' => 'b', 'value' => '2' ) ) ) );
$r = array( 'cookies' => array( new WP_Http_Cookie( array( 'name' => 'x', 'value' => 'y' ) ) ), 'headers' => array() );
WP_Http::buildCookieHeader( $r );
return array( get_class( $jar ), array_keys( iterator_to_array( $jar ) ), $r['headers']['cookie'] );
