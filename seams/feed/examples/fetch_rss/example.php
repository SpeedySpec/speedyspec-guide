<?php
// Fetches and parses an RSS feed with MagpieRSS, cached in transients for an hour; gives the MagpieRSS object or false. Part of MagpieRSS, deprecated since 3.0; use fetch_feed().
require_once ABSPATH . WPINC . '/rss.php';
guide_queue_http( array( '<?xml version="1.0"?><rss version="2.0"><channel><title>Tea News</title><item><title>Sencha season</title><link>https://example.org/sencha</link></item></channel></rss>' ) );
$rss = fetch_rss( 'https://example.org/feed/' );
return array( $rss->channel['title'], $rss->items[0]['title'] );
