<?php
// Fetches and parses an RSS or Atom feed with SimplePie, cached in transients for 12 hours; gives the SimplePie object or an error. wp_feed_options and wp_feed_cache_transient_lifetime adjust it.
guide_queue_http( array( '<?xml version="1.0"?><rss version="2.0"><channel><title>Tea News</title><link>https://example.org/</link><item><title>Sencha season</title><link>https://example.org/sencha</link></item><item><title>Matcha tips</title><link>https://example.org/matcha</link></item></channel></rss>' ) );
$feed = fetch_feed( 'https://example.org/feed/' );
return array( $feed->get_title(), $feed->get_item_quantity(), $feed->get_item( 0 )->get_title() );
