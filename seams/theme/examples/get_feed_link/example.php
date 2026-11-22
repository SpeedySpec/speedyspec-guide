<?php
// A site feed's URL, by type (rss2 by default, comments_rss2 for comments); filtered by feed_link.
$plain = array( get_feed_link(), get_feed_link( 'comments_rss2' ) );
update_option( 'permalink_structure', '/%year%/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return array( $plain, get_feed_link( 'atom' ) );
