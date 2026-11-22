<?php
// Fetches a URL with the HTTP API and gives a Snoopy-like object with status, headers and body, or status 500 with the error. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
init();
guide_queue_http( array( '<rss version="2.0"><channel><title>Tea News</title></channel></rss>' ) );
$response = _fetch_remote_file( 'https://example.org/feed/' );
return array( $response->status, strlen( $response->results ) > 0 );
