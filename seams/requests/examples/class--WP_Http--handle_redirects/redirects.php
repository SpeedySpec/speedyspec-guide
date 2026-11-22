<?php
// For the old transports: follows a Location header on a 3xx, unless redirects are used up or turned off; a 302/303 becomes a GET.
$response = array( 'headers' => array( 'location' => '/next' ), 'response' => array( 'code' => 302 ) );
return array( WP_Http::handle_redirects( 'http://example.org/a', array( 'redirection' => 0 ), $response ), WP_Http::handle_redirects( 'http://example.org/a', array( 'redirection' => 2 ), array( 'headers' => array(), 'response' => array( 'code' => 200 ) ) ) );
