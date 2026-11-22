<?php
// The static helpers: processResponse() splits raw headers from the body, processHeaders() parses headers and cookies, chunkTransferDecode() decodes a chunked body. processResponse() splits at the first blank line, so after a redirect the second response stays in the body; the decoder doesn't skip the line break after each chunk's data, so a standard chunked body comes back unchanged.
$raw = "HTTP/1.1 301 Moved\r\nLocation: /x\r\n\r\nHTTP/1.1 200 OK\r\nA: 1\r\nA: 2\r\nSet-Cookie: c=d\r\n\r\nbody";
$split = WP_Http::processResponse( $raw );
$headers = WP_Http::processHeaders( $split['headers'] );
return array( $split['body'], $headers['response'], $headers['headers'], $headers['cookies'], WP_Http::chunkTransferDecode( "4\r\nWiki\r\n5\r\npedia\r\n0\r\n\r\n" ), WP_Http::chunkTransferDecode( "4\r\nWiki5\r\npedia0" ), WP_Http::chunkTransferDecode( 'plain' ) );
