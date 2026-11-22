<?php
// Sends a request through the transport and parses the response: status, headers, body, cookies; the request gets default headers and options.
use WpOrg\Requests\Requests;
$opts = array( 'transport' => 'Guide_Queue_Transport' );
Guide_Queue_Transport::$responses[] = "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello";
$r = Requests::get( 'http://example.org/path?q=1', array( 'Accept' => 'text/plain' ), $opts );
return array( $r->status_code, $r->success, $r->body, $r->headers['content-type'], $r->headers['x-two'], $r->headers->getValues( 'X-Two' ), $r->url, $r->protocol_version, Guide_Queue_Transport::$sent[0]['method'], Guide_Queue_Transport::$sent[0]['headers'] );
