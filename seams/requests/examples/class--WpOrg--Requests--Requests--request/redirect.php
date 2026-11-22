<?php
// Redirects are followed (up to 10), each response kept in history; a 303 becomes a GET.
use WpOrg\Requests\Requests;
$opts = array( 'transport' => 'Guide_Queue_Transport' );
Guide_Queue_Transport::$responses = array( "HTTP/1.1 303 See Other\r\nLocation: /next\r\n\r\n", "HTTP/1.1 200 OK\r\n\r\ndone" );
$r = Requests::post( 'http://example.org/form', array(), array( 'a' => 1 ), $opts );
return array( $r->body, $r->url, $r->redirects, count( $r->history ), $r->history[0]->status_code, array_column( Guide_Queue_Transport::$sent, 'method' ), array_column( Guide_Queue_Transport::$sent, 'url' ) );
