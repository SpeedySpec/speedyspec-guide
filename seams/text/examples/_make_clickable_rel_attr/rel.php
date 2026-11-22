<?php
// The rel attribute for links make_clickable() creates: nofollow for an outside http(s) link, nothing for one to this site (http://example.org here), unless filtered.
$outside = _make_clickable_rel_attr( 'https://example.com' );
$inside = _make_clickable_rel_attr( 'http://example.org/page' );
add_filter( 'make_clickable_rel', fn() => 'external' );
return array( $outside, $inside, _make_clickable_rel_attr( 'https://example.com' ) );
