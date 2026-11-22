<?php
// Methods and options: follow_redirects off, a data_format of body or query, and hooks before and after; an invalid URL type throws.
use WpOrg\Requests\Requests;
$opts = array( 'transport' => 'Guide_Queue_Transport' );
Guide_Queue_Transport::$responses = array( "HTTP/1.1 302 Found\r\nLocation: /x\r\n\r\n", "HTTP/1.1 200 OK\r\n\r\n" );
$hooks = new WpOrg\Requests\Hooks();
$hooks->register( 'requests.before_request', function ( &$url ) { $url .= '&hooked=1'; } );
$r = Requests::request( 'http://example.org/?a=1', array(), array(), Requests::DELETE, $opts + array( 'follow_redirects' => false, 'hooks' => $hooks ) );
$q = Requests::request( 'http://example.org/', array(), array( 'b' => 2 ), Requests::GET, $opts );
try { Requests::request( 5 ); } catch ( WpOrg\Requests\Exception\InvalidArgument $e ) { $err = $e->getMessage(); }
return array( $r->status_code, $r->is_redirect(), array_column( Guide_Queue_Transport::$sent, 'url' ), array_column( Guide_Queue_Transport::$sent, 'method' ), $err );
