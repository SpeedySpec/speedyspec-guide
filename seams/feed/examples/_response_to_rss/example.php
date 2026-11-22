<?php
// Parses a fetched response into a MagpieRSS object, keeping its ETag and Last-Modified headers for the cache. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
init();
$response = (object) array( 'status' => 200, 'headers' => array( 'etag: "abc"' ), 'results' => '<?xml version="1.0"?><rss version="2.0"><channel><title>Tea News</title><item><title>Sencha season</title><link>https://example.org/sencha</link></item></channel></rss>' );
$rss = _response_to_rss( $response );
return array( $rss->channel['title'], count( $rss->items ), $rss->etag );
