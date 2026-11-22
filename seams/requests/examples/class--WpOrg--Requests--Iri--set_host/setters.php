<?php
// Setting parts checks them: a bad port or host is refused; IPv6 hosts are bracketed and compressed.
$iri = new WpOrg\Requests\Iri( 'http://example.org/' );
// The setters are protected; they run when a property is set, and get() gives their result.
$set = fn( $method, $value ) => Closure::bind( fn() => $this->$method( $value ), $iri, WpOrg\Requests\Iri::class )();
return array( $set( 'set_port', 'x' ), $set( 'set_port', 8080 ), $set( 'set_host', '[::1]' ), (string) $iri, $set( 'set_host', '[nope]' ), $set( 'set_path', '/a b' ), $iri->authority, $iri->path );
