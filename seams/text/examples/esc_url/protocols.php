<?php
// With a list of protocols, only those pass: a URL refused is '' at once; clean_url gets one that passes, with the original and the context.
add_filter( 'clean_url', fn( $good, $orig, $ctx ) => "$ctx:$good", 10, 3 );
return array( esc_url( 'ftp://example.com/', array( 'http', 'https' ) ), esc_url( 'https://example.com/', array( 'https' ) ) );
