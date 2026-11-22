<?php
// Sends several requests together, keyed as given; each gets its own response (or exception).
use WpOrg\Requests\Requests;
$opts = array( 'transport' => 'Guide_Queue_Transport' );
Guide_Queue_Transport::$responses = array( "HTTP/1.1 200 OK\r\n\r\none", "HTTP/1.1 404 Not Found\r\n\r\ntwo" );
$r = Requests::request_multiple( array( 'a' => array( 'url' => 'http://example.org/1' ), 'b' => array( 'url' => 'http://example.org/2' ) ), $opts );
return array( array_keys( $r ), $r['a']->body, $r['b']->status_code, $r['b']->success );
