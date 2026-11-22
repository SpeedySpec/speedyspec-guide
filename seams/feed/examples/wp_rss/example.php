<?php
// Prints a feed's items as a list of links, all of them or a number. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
guide_queue_http( array( '<?xml version="1.0"?><rss version="2.0"><channel><title>Tea News</title><item><title>Sencha season</title><link>https://example.org/sencha</link><description>Fresh leaves</description></item></channel></rss>' ) );
return guide_render( fn() => wp_rss( 'https://example.org/feed/', 1 ) );
