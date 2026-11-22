<?php
// Keeps the http and https URLs, one per line; sanitize_trackback_urls gets the result and the original.
function guide_bracket_trackback_urls( $urls, $to_ping ) {
	return "[$urls]";
}
add_filter( 'sanitize_trackback_urls', 'guide_bracket_trackback_urls', 10, 2 );
return sanitize_trackback_urls( " https://example.com/a ftp://x example.com\nhttp://example.com/b " );
