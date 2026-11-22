<?php
// Cookies from a response's Set-Cookie headers; a jar sends them back on later requests to the site.
$opts = array( 'transport' => 'Guide_Queue_Transport', 'cookies' => new WpOrg\Requests\Cookie\Jar( array( 'pre' => 'set' ) ) );
Guide_Queue_Transport::$responses = array( "HTTP/1.1 302 Found\r\nSet-Cookie: sid=1; Path=/\r\nLocation: /in\r\n\r\n", "HTTP/1.1 200 OK\r\n\r\n" );
$r = WpOrg\Requests\Requests::get( 'http://example.org/login', array(), $opts );
return array( array_keys( iterator_to_array( $r->cookies ) ), Guide_Queue_Transport::$sent[0]['headers']['Cookie'] ?? null, Guide_Queue_Transport::$sent[1]['headers']['Cookie'] ?? null );
