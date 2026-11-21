<?php
// Keeps the http and https URLs, one per line; sanitize_trackback_urls gets the result and the original.
add_filter( 'sanitize_trackback_urls', fn( $urls, $to_ping ) => "[$urls]", 10, 2 );
return sanitize_trackback_urls( " https://example.com/a ftp://x example.com\nhttp://example.com/b " );
