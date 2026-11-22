<?php
// Parses a Set-Cookie value with its attributes (expires, max-age as an expiry time, domain, path), and matches it to URIs. A parsed cookie is host-only until parse_from_headers() clears that for a Domain attribute, so only the exact domain matches here; Secure cookies match only https.
use WpOrg\Requests\Cookie;
use WpOrg\Requests\Iri;
$c = Cookie::parse( 'id=abc; Max-Age=60; Domain=example.org; Path=/docs; Secure', '', 1000 );
return array( $c->name, $c->value, (string) $c, $c->attributes['max-age'], $c->is_expired(), $c->domain_matches( 'www.example.org' ), $c->domain_matches( 'example.com' ), $c->path_matches( '/docs/a' ), $c->path_matches( '/doc' ), $c->uri_matches( new Iri( 'https://example.org/docs/x' ) ), $c->uri_matches( new Iri( 'http://example.org/docs/x' ) ), $c->format_for_header(), $c->format_for_set_cookie() );
