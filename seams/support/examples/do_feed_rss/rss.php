<?php
// Loads the RSS 0.92 feed template, feed-rss.php.
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
wp( array( 'feed' => 'rss' ) );
return str_contains( guide_render( 'do_feed_rss' ), '<rss version="0.92">' );
