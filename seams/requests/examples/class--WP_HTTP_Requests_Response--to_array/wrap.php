<?php
// Wraps a Requests response for the HTTP API: headers, status, body and cookies through WP_HTTP_Response's methods, and to_array() for the response array.
$raw = new WpOrg\Requests\Response();
$raw->status_code = 200;
$raw->body = 'hi';
$raw->headers['Content-Type'] = 'text/plain';
$raw->cookies['c'] = new WpOrg\Requests\Cookie( 'c', 'v' );
$r = new WP_HTTP_Requests_Response( $raw );
$r->header( 'X-Extra', '1' );
return array( $r->get_status(), $r->get_data(), get_class( $r->get_headers() ), $r->get_headers()['x-extra'], $r->get_cookies()[0]->name, get_class( $r->get_response_object() ), array_keys( $r->to_array() ), $r->to_array()['response'] );
