<?php
// Parsing decodes chunked bodies and compressed ones (gzip, deflate); it doesn't skip an interim 100 Continue, which the real transports strip before it, so here the 100 is taken as the status. A response without a header/body separator throws.
use WpOrg\Requests\Requests;
$opts = array( 'transport' => 'Guide_Queue_Transport' );
$gz = gzencode( 'zipped' );
Guide_Queue_Transport::$responses = array( "HTTP/1.1 100 Continue\r\n\r\nHTTP/1.1 200 OK\r\nTransfer-Encoding: chunked\r\n\r\n5\r\nHello\r\n0\r\n\r\n", "HTTP/1.1 200 OK\r\nContent-Encoding: gzip\r\n\r\n" . $gz, 'garbage' );
$a = Requests::get( 'http://example.org/', array(), $opts );
$b = Requests::get( 'http://example.org/', array(), $opts );
try { Requests::get( 'http://example.org/', array(), $opts ); } catch ( WpOrg\Requests\Exception $e ) { $err = array( $e->getType(), $e->getMessage() ); }
return array( $a->body, $a->status_code, $b->body, $err );
