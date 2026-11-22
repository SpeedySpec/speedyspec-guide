<?php
// The date of the latest change among the feed's posts and comments, in a date format; filtered by get_feed_build_date.
wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00', 'post_modified' => '2026-03-15 10:00:00' ) );
guide_go( '/?feed=rss2' );
return get_feed_build_date( 'r' );
