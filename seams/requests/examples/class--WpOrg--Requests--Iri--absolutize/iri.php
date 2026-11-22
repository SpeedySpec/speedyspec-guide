<?php
// IRIs: parsing into parts, resolving a relative reference against a base (removing dot segments), and converting to a URI.
use WpOrg\Requests\Iri;
$base = new Iri( 'http://user@Example.ORG:80/a/b/c?q#f' );
$abs = Iri::absolutize( 'http://example.org/a/b/c', '../d/./e?x=1' );
$unicode = new Iri( 'http://example.org/café?ü' );
return array( $base->scheme, $base->host, $base->port, $base->path, $base->query, $base->fragment, $base->iuserinfo, (string) $base, (string) $abs, Iri::absolutize( 'relative/only', 'x' ), $unicode->uri, $unicode->iri, $base->is_valid() );
