<?php
// A session keeps a base URL, headers, data and options for each request, merged with what each request adds.
$s = new WpOrg\Requests\Session( 'http://example.org/api/', array( 'X-Key' => 'k' ), array(), array( 'transport' => 'Guide_Queue_Transport' ) );
$s->useragent = 'Guide';
Guide_Queue_Transport::$responses = array( "HTTP/1.1 200 OK\r\n\r\nok" );
$r = $s->get( 'items?page=2', array( 'X-More' => 'm' ) );
return array( $r->body, Guide_Queue_Transport::$sent[0]['url'], Guide_Queue_Transport::$sent[0]['headers']['X-Key'], Guide_Queue_Transport::$sent[0]['headers']['X-More'], $s->useragent, isset( $s->url ) );
