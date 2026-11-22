<?php
// A cookie from an array or a Set-Cookie string, with its attributes; test() checks it applies to a URL, getHeaderValue() (wp_http_cookie_value filters it) and getFullHeader() format it.
$c = new WP_Http_Cookie( 'id=abc; expires=Thu, 01 Jan 2099 00:00:00 GMT; path=/docs; domain=.example.org', 'http://example.org/docs/x' );
add_filter( 'wp_http_cookie_value', fn( $v, $name ) => "[$v]", 10, 2 );
return array( $c->name, $c->value, $c->path, $c->domain, $c->expires, $c->test( 'http://www.example.org/docs/y' ), $c->test( 'http://example.org/other' ), $c->test( 'http://other.example/docs/' ), $c->getHeaderValue(), $c->getFullHeader(), $c->get_attributes() );
