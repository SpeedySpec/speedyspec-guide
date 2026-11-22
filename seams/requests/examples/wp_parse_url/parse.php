<?php
// parse_url() that handles protocol-relative and relative URLs consistently, and one component by PHP_URL_ constant.
return array( wp_parse_url( '//example.org/a?b=1' ), wp_parse_url( '/path?x=1#f' ), wp_parse_url( 'https://example.org:8080/x', PHP_URL_PORT ), wp_parse_url( 'https://example.org/x', PHP_URL_FRAGMENT ), wp_parse_url( 'http:///nope' ) );
